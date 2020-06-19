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
        $this->getDatas();

        /// There are 2 buttons in the view with the name modify with values of either add or delete
        /// Check the value to know which button was called
        if ($request->modify == "add")
        {
            /// Request returns the checkboxes that were checked and return it as an array with the array index
            foreach ($request->addCheck as $personIndex)
            {
                $this->dbNewPersons(intval($personIndex));
            }

            foreach ($request->addCheck as $personIndex)
            {
                $this->dbNewClasses(intval($personIndex));
            }

            $request->session()->flash('status', 'Personnes sélectionées ajoutées');
        }
        else if ($request->modify == "delete")
        {
            /// Request returns the checkboxes that were checked and return their values which are the intranet user id
            /// The id is used to find the person in the database and then soft delete it
            foreach ($request->deleteCheck as $personIntranetId)
            {
                $this->dbObsoletePersons($personIntranetId);
            }

            $request->session()->flash('status', 'Personnes obsolètes sélectionées supprimées');
        }
        return redirect('/synchro');
    }

    /**
     * getDatas
     * 
     * This method will get the datas we need from the intranet API or the database.
     * It will also sort the returned arrays for a better view.
     * The method will compare what is on the intranet and on the database.
     * If both the datas on the intranet and the database are similar, it will put these datas in a class attribute called $goodPersons.
     * If datas are present in the intranet but not in the database, it will put the datas in the class attribute $newPersons.
     * If datas are in the database but not returned from the intranet, it will put the datas in the class attribute $obsoletePersons.
     * 
     * @return void
     */
    public function getDatas()
    {
        $dbStudents = Person::all();
        $dbStudents = $dbStudents->sortBy('lastname');
        $intranetDatas = new IntranetConnection();
        $this->classesList = $intranetDatas->getClasses();
        $studentsList = $intranetDatas->getStudents();
        $teachersList = $intranetDatas->getTeachers();
        $personsList = array_merge($studentsList, $teachersList);

        foreach($dbStudents as $student)
        {
            /// Check if the person exists with the unique intranet user id
            if(in_array($student->intranetUserId, array_column($personsList, 'id')))
            {
                array_push($this->goodPersons, $student);
            }
            else
            {
                if ($student->obsolete == 0)
                {
                    array_push($this->obsoletePersons, $student);
                }
            }
        }

        foreach($personsList as $person)
        {
            if(!$dbStudents->contains('intranetUserId', $person['id']))
            {
                array_push($this->newPersons, $person);
            }
        }

        /// Simple function to sort the JSON returned by the API by lastname
        usort($this->newPersons,function($a,$b) {return strnatcasecmp($a['lastname'],$b['lastname']);});
    }

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
            //$this->getDatas();

            $intranetData = new IntranetConnection();
            return view('synchro/index')->with([ "classes" => $intranetData->getClasses()]);
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