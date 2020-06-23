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
    public function index($message = null)
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
                    //check if classroom and student exists
                    if(Flock::where("flockName",$className)->exists())
                        $classrooms[$key]["students"][$studentKey]["exists"] = (Person::where("intranetUserId",$student["id"])->exists());
                    else
                        $classrooms[$key]["students"][$studentKey]["exists"] = false;
                } 
                //check the classMaster existing on db
                if(Flock::where("classMaster_id", Person::where("intranetUserId",$classrooms[$key]['teacher']["id"])->exists()))
                    $classrooms[$key]["teacher"]["exists"] = Person::where("intranetUserId",$classrooms[$key]['teacher']["id"])->exists();
                else
                    $classrooms[$key]["teacher"]["exists"] = false;
                if(strpos($key, "MI"))
                {
                    //merge matu on cfc
                    foreach($classroom['students'] as $studentKey => $student)
                        array_push($classrooms[str_replace("MI","C",$key)]['students'],$classrooms[$key]["students"][$studentKey]);
                    unset($classrooms[$key]);
                }  
            }
            return view('synchro/index')->with(compact("classrooms","message"));
        }
    }

    public function modify(Request $request)
    {
        $intranetConnection = new IntranetConnection();
        $people = [];
        $message = "";
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
            $exist = Person::where([
                ["firstname", $person["firstname"]],
                ["lastname", $person["lastname"]]
            ])->exists();
            //create user
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
                //create email for each person
                $contactInfo = new Contactinfos();
                $contactInfo->contacttypes_id = Contacttypes::EMAIL;
                $contactInfo->persons_id = $user->id;
                $contactInfo->value = $person['email'];
                $contactInfo->save();

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
                //can't add student on not existing classroom
                if(Flock::where("flockName", $person["current_class"]["link"]["name"])->exists())
                    $user->flock_id = Flock::where("flockName", $person["current_class"]["link"]["name"])->first()->id;
                else
                    $message = "La classe ".$person["current_class"]["link"]["name"]." n'a pas de maître de classe";
                $user->save();
            }
        }
        return redirect()->action("SynchroController@index", $message);
    }
}