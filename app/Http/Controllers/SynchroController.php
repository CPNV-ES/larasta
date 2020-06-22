<?php
/**
 * Title : SynchroController.php
 * Author : Steven Avelino
 * Creation Date : 12 December 2017
 * Modification Date : 23 January 2018
 * Version : 0.4
 * Controller for the Synchronisation between the intranet API and this application database
*/

namespace App\Http\Controllers;

/**
 * We use 3 models in this controller
 * IntranetConnection : Model for the connection to the intranet API. We retrieve the students, teachers and classes.
 * Persons : Eloquent model for the table "persons" in the MySQL database.
 * Flock : Eloquent model for the table "flocks" in the MySQL database.
 * 
 * Use of Carbon to handle dates easily
*/

use App\Contactinfos;
use App\Contacttypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CPNVEnvironment\Environment;
use App\Person;
use App\Flock;
use App\IntranetConnection;
use Carbon\Carbon;

class SynchroController extends Controller
{
    /**
     * Class attributes
     * $goodPersons : Array that contains the people that are both in the intranet and in the application database.
     * $obsoletePersons : Array that contains the people in the application database but not in the intranet.
     * $newPersons : Array that contains the people that were found in the intranet but not in the application database
     * $classesList : Array that contains all the classes retrieved from the intranet
    */
    private $goodPersons = [];
    private $obsoletePersons = [];
    private $newPersons = [];
    private $classesList;

    /**
     * index
     * 
     * This method is the method called in the route to display the main view of the functionnality.
     * It will simply call the getDatas method to initialize the connections and get the datas needed to return to the view.
     * It will then return the view with the 3 main class attributes : $goodPersons, $newPersons, $obsoletePersons.
     * 
     * @return view
     */
    public function index()
    {
        /// Should be at > 0 in a production environment
        if (Auth::user()->person->role < 5)
        {
            $intranetData = new IntranetConnection();
            $classrooms = $intranetData->getSpecificClassesWithStudentsAndTeacher("#^SI-\w+3\w+$#");
            foreach($classrooms as $key=>$classroom)
            {                             
                foreach($classroom['students'] as $studentKey => $student)
                {
                    $className = str_replace("MI","C",$key);
                    $classrooms[$key]["students"][$studentKey]["exists"] = (Person::where([
                        ["intranetUserId",$student["id"]],
                        ["flock_id", Flock::where("flockName",$className )->first()->id],
                    ])->exists());
                } 
                $classrooms[$key]["teacher"]["exists"] = Person::where("intranetUserId",$classrooms[$key]['teacher']["id"])->exists() && Flock::where("classMaster_id", Person::where("intranetUserId",$classrooms[$key]['teacher']["id"])->first()->id)->exists();
                if(strpos($key, "MI"))
                {
                    foreach($classroom['students'] as $studentKey => $student)
                        array_push($classrooms[str_replace("MI","C",$key)]['students'],$classrooms[$key]["students"][$studentKey]);
                    unset($classrooms[$key]);
                }  
            }
            return view('synchro/index')->with([ "classes" => $classrooms]);
        }
    }

    /**
     * modify
     * 
     * This method will synchronize the database with the intranet.
     * It takes the different datas from the intranet and the database to put them in the class attributes
     * Take the request and check which action was asked from the user.
     * Take the checkboxes that were checked and their index if the action was adding new people and the intranet id if it was deleting people
     * It called their respective method.
     * 
     * @param Request $request
     * 
     * @return redirect
     */
    public function modify(Request $request)
    {
        $intranetConnection = new IntranetConnection();
        $people = [];
        //get information of all checked people
        foreach ($request->request as $key => $value)
        {
            if($key == "_token")   
                continue;
            
            if(isset($value['status']))
                if($value["occupation"] == "Elève")
                    array_push($people, $intranetConnection->searchStudent($value['friendly_id']));
                else
                    array_push($people, $intranetConnection->searchTeacher($value['friendly_id']));
        }

        foreach($people as $key => $person)
        {
            //create user
            $exist = Person::where([
                ["firstname", $person["firstname"]],
                ["lastname", $person["lastname"]]
            ])->exists();
            if(!$exist)
            {
                $user = new Person();
                $user->firstname = $person["firstname"];
                $user->lastname = $person["lastname"];
                //if teacher the role value is 1
                $user->role = ($person["occupation"] == "Enseignant")? 1 : 0;
                //only teachers have acronym
                $user->initials = ($person["occupation"] == "Enseignant")? $person["acronym"] : null;
                $user->intranetUserId = $person["id"];
                $user->upToDateDate = $person["updated_on"];
                //TODO create unique acronym on db!
                $user->initials=$person["firstname"][0].$person["lastname"][0].$person["lastname"][strlen($person["lastname"])-1];
                $user->save();
            }
            else
            {
                $user = Person::where([
                    ["firstname", $person["firstname"]],
                    ["lastname", $person["lastname"]]
                ])->first();
            }

            //create classroom
            if($person["occupation"] == "Enseignant")
            {
                
                $classroomName = $person["current_class_masteries"][0]["link"]["name"];                
                $exist = Flock::where("flockName", $classroomName)->exists();
                if(!$exist)
                {
                    $flock = new Flock();
                    $flock->flockName = $classroomName;
                    //sub 3 years before september and 4 years after
                    $year = (Carbon::now()->month >= 8)? Carbon::now()->subYear(3)->year : Carbon::now()->subYear(4)->year;
                    $flock->startYear = substr($year,-2);
                }   
                else
                {
                    $flock = Flock::where("flockName", $classroomName)->first();
                }   
                $flock->classMaster_id = $user->id; 
                $flock->save();
            }
            else
            {
                //if the student is in school maturity  => 1
                $user->mpt = strpos($person["current_class"]["link"]["name"],"MI")? 1 : 0; 
                //matus is insert on cfc classroom
                $person["current_class"]["link"]["name"] = str_replace("MI","C",$person["current_class"]["link"]["name"]);
                $user->flock_id = Flock::where("flockName", $person["current_class"]["link"]["name"])->first()->id;
                $user->save();
            }

        }
        return redirect('/synchro');
    }

    /**
     * dbObsoletePersons
     * 
     * This method is called by the method modify, that take the datas from the synchro view.
     * It will take a person intranet id, then search for it in the database, then set the "obsolete" field to 1.
     * 
     * @param $personIntranetId id from the intranet retrieved from the intranet API
     * 
     * @return void
    */
    protected function dbObsoletePersons($personIntranetId)
    {
        $person = Person::where('intranetUserId', $personIntranetId);
        $person->obsolete = 1;

        $person->save();
    }

    /**
     * dbNewPersons
     * 
     * This method is called by the method modify, that take the datas from the synchro view.
     * It will take the index of a person selected and then add it to the database with the informations needed that were retrieved from the intranet.
     * 
     * @param $personIndex index in the array of people created from the difference between the intranet API and the application database
     * 
     * @return void
     */
    protected function dbNewPersons($personIndex)
    {
        $person = new Person;

        $person->firstname = $this->getNewPersons()[$personIndex]['firstname'];
        $person->lastname = $this->getNewPersons()[$personIndex]['lastname'];
        $person->upToDateDate = $this->getNewPersons()[$personIndex]['updated_on'];
        $person->intranetUserId = $this->getNewPersons()[$personIndex]['id'];
        /// The intranet sometime returns 2 different values for the occupation field for students so it handles both
        if ($this->getNewPersons()[$personIndex]['occupation'] == "Elève" || $this->getNewPersons()[$personIndex]['occupation'] == "Eleve")
        {
            $person->role = 0;
        }
        else
        {
            $person->role = 1;
        }
    
        $person->save();
    }

    /**
     * dbNewClasses
     * 
     * This method is called by the method modify, that take the datas from the synchro view.
     * Similar to the "dbNewPersons" method, this method will check if the classes in the database exists.
     * If they don't, it will create them with the same of the class and its start year.
     * It will update the "persons" table and add a flock_id to the people freshly added.
     * 
     * @param $personIndex index in the array of people created from the difference between the intranet API and the application database
     * 
     * @return void
     */
    protected function dbNewClasses($personIndex)
    {
        if (Person::where('intranetUserId', $this->getNewPersons()[$personIndex]['id'])->where('role', 0)->exists())
        {
            /// Only need to add the flock_id to students, so role = 0
            $person = Person::where('intranetUserId', $this->getNewPersons()[$personIndex]['id'])->where('role', 0)->first();
            /// Split the string returned by the intranet API for the date the person was updated on to get the starting year
            $dateSplit = explode('-', $this->getNewPersons()[$personIndex]['updated_on']);
            $flockId = $this->checkFlock($this->getNewPersons()[$personIndex]['current_class']['link']['name']);

            $person->flock_id = $flockId;

            $person->save();
        }
    }

    /**
     * addFlock
     * 
     * Method called in the "checkFlock" method, in case a class needs to be created.
     * This method will add a new class to the database
     * the name of the class is the name of the class in reality and the year when the class started.
     * It takes the class master from the intranet.
     * 
     * @param $startYear Year when the class started
     * @param $className Name of the class
     * 
     * @return int
     */
    public function addFlock($startYear, $className)
    {
        $flock = new Flock;

        $flock->flockName = $className . $startYear;
        $flock->startYear = $startYear;

        foreach($this->getClasses() as $classe)
        {
            if ($classe['name'] == $className)
            {
                if ($classe['master'] != null) {
                    if (Person::where('intranetUserId', $classe['master']['link']['id'])->exists())
                    {
                        $person = Person::where('intranetUserId', $classe['master']['link']['id'])->first();
                        $flock->classMaster_id = $person->id;
                    }
                    else
                    {
                        $flock->classMaster_id = null;
                    }
                }
            }
        }

        $flock->save();

        return $flock->id;
    }

    /**
     * checkFlock
     * 
     * Method called in the "dbNewClasses" method.
     * This method will check if a class for a student exists and will return the id to put in the "flock_id" of the person in the database
     * If the class doesn't exist, it will call the "addFlock" method to create it.
     * 
     * @param $className Name of the class
     * 
     * @return int
     */
    public function checkFlock($className)
    {
        $todayDate = Carbon::today();

        $classYear = str_split($className);

        if ($todayDate->month >= 8)
        {
            $startYear = $todayDate->year - intval($classYear[4]);
        }
        else
        {
            $startYear = $todayDate->year - intval($classYear[4]) - 1;
        }

        if (Flock::where('startYear', $startYear)->exists())
        {
            $flocks = Flock::where('startYear', $startYear)->get();
            
            foreach ($flocks as $flock)
            {
                if ($flock->flockName == $className . $startYear)
                {
                    return $flock->id;
                }
            }

            return $this->addFlock($startYear, $className, $this->classesList);
        }
        else
        {
            return $this->addFlock($startYear, $className, $this->classesList);   
        }

    }

    /**
     * getGoodPersons
     * Getter for the attribute goodPersons
     * 
     * @return array
     */
    public function getGoodPersons()
    {
        return $this->goodPersons;
    }

    /**
     * getObsoletePersons
     * Getter for the attribute obsoletePersons
     * 
     * @return array
     */
    public function getObsoletePersons()
    {
        return $this->obsoletePersons;
    }

    /**
     * getNewPersons
     * Getter for the attribute newPersons
     * 
     * @return array
     */
    public function getNewPersons()
    {
        return $this->newPersons;
    }

    /**
     * getClasses
     * Getter for the attribute classesList
     * 
     * @return array
     */
    public function getClasses()
    {
        return $this->classesList;
    }
}