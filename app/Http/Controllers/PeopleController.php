<?php

/**
 * Created by PhpStorm.
 * User: Davide.CARBONI
 * Date: 18.12.2017
 * Time: 09:06
 *
 * !!!!! IMPORTANT !!!!
 * ONLY FOR TEACHER ROLE
 * If you want have all contacts informations for teacher -> do nothing
 * If you want have nothing information for teacher so go to the STEP by STEP procedure
 * STEP by STEP: folow the step procedure starting in the Step 1 in the update function
 * After finished go to PeopleEdit blade and follow the same procedure
 */

namespace App\Http\Controllers;

use App\Company;
use App\Contactinfos;
use App\Contacttypes;
use App\Flock;
use App\Internship;
use Illuminate\Http\Request;
use App\Person;
use CPNVEnvironment\Environment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PeopleController extends Controller
{
    /**
     * Get all peoples and return in the view
     * Passing first filter for teacher (0->student, 1->teacher, 2->company)
     * Passing first filter for Obsolete (0->desactivate, 1->activate)
     */
    public function index()
    {
        // Get the user right
        $user = Auth::user()->person;

        $persons = Person::where('obsolete', 0)
            ->orderBy('firstname', 'asc')
            ->get();
        // return all value to view
        return view('people/index')->with(
            [
                'persons' => $persons,
                'user' => $user,
                'filterCategory' => ["0", "1", "2"],
                'filterObsolete' => null
            ]
        );
    }

    public function create(){
        return view('people/create');
    }

    /**
     * Get peoples that match the filter and return in the view
     *
     * @param $request
     */
    public function category(Request $request)
    {
        //$request->flash();
        // Get post values from the form
        $filtersCategory = $request->input('filterCategory');
        $filterName = $request->input('filterName');
        $filterObsolete = $request->input('filterObsolete');

        // Verify if all checkboks are not selected
        if ($filtersCategory == null) $filtersCategory = ["-1"];

        // Get the user right
        $user = Auth::user()->person;

        // Apply scope form Model Persons and get data
        $persons = Person::obsolete($filterObsolete)->category($filtersCategory)->orderBy('firstname', 'asc')->Name($filterName)->get();

        // return all value to view with the value of filters
        return view('people/people')->with(
            [
                'persons' => $persons,
                'user' => $user,
                'filterCategory' => $filtersCategory,
                'filterName' => $filterName,
                'filterObsolete' => $filterObsolete
            ]
        );
    }

    /**
     * Delete a specific contact
     *
     * @param $request
     */
    public function deleteContact(Request $request)
    {
        $delid = $request->input('delid');
        $personid = $request->input('peopleid');
        Contactinfos::destroy($delid);
        return $this->show($personid);
    }

    /**
     * Add a contact to a person
     *
     * @param $request
     */
    public function addContact(Request $request)
    {
        $personid = $request->input('peopleid');
        $newcontact = new Contactinfos();
        $newcontact->contacttypes_id = $request->input('contacttype');
        $newcontact->persons_id = $personid;
        $newcontact->value = $request->input('newcontact');
        $newcontact->save();
        return $this->show($personid);
    }

    /**
     * Change a person's company
     *
     * @param $request
     */
    public function changeCompany(Request $request)
    {
        $personid = $request->input('peopleid');
        $newcompany = $request->input('dpdCompany');
        $person = Person::find($personid);
        $person->company_id = $newcompany;
        $person->save();
        return $this->show($personid);
    }

    public function show($id){
        $person = Person::findOrFail($id);
        return view('people/show', compact("person"));
    }
    /**
     * Get all info for people
     *
     * @param $id
     */
    public function edit($id)
    {
        // Get the user right
        $user = Auth::user()->person;

        // Read Person from DB
        $person = Person::find($id);

        // Read Adresse from DB
        $adress =  Person::find($id)->location;

        // Read Contact info from DB
        $contacts = Contactinfos::where('persons_id', $id)->get();

        // Read Contact types from DB
        $contacttypes = Contacttypes::all();

        // Read Company from DB
        $companies = Company::all();

        // select the internships in which the person was involved, based on role
        switch ($person->role) {
            case 0: // Student
                $iship = Internship::where('intern_id', $id)->get();
                break;
            case 1: //TODO teacher          
                break;

            case 2: // company
                $iship = Internship::where('responsible_id', $id)->get();
                break;
        }
        // return all values in view
        return view('people/peopleEdit')->with(
            [
                'person' => $person,
                'adress' => $adress,
                'contacts' => $contacts,
                'iships' => $iship,
                'user' => $user,
                'contacttypes' => $contacttypes,
                'companies' => $companies
            ]
        );
    }

    /**
     * Update all value for the selected people
     *
     * @param $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        // Extract all the values int he Request
        $Role = $request->input('role');
        $Adress1 = $request->input('adress1');
        $Adress2 = $request->input('adress2');
        $PostalCode = $request->input('postalCode');
        $City = $request->input('city');
        $LocationID = $request->input('locationID');
        $Mails = $request->input('mail');
        $FixePhones = $request->input('phoneFixe');
        $MobilePhones = $request->input('phoneMobile');

        ///////////////////////////////////////
        /// Obsolete
        ///////////////////////////////////////

        // Create the value to Obsolote to insert in the DB (0,1)
        $Obsolete = ($request->input('obsolete') ==  null) ? 0 : 1;

        ///////////////////////////////////////
        /// Adress
        ///////////////////////////////////////

        // Desactive or Activate the person in the DB
        DB::table('persons')
            ->where('id', $id)
            ->update(['obsolete' => $Obsolete]);

        // Change adress values for all people except if the role is teacher
        if ($Role != 1) {
            // Create de adress with all value to goole maps
            $address = $Adress1 . "," . $PostalCode . "," . $City;
            $address = str_replace(" ", "+", $address);

            // Google Maps get long and lat values
            // Get JSON results from this request
            $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=false');
            $geo = json_decode($geo, true); // Convert the JSON to an array

            // Verify if the answer from google maps is OK
            if (isset($geo['status']) && ($geo['status'] == 'OK')) {
                $lat = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                $long = $geo['results'][0]['geometry']['location']['lng']; // Longitude
            } else
                // Put Null value if long e lat is not available
                $lat = $long = NULL;

            // Modifify data location for the selectes person
            DB::table('locations')
                ->where('id', $LocationID)
                ->update([
                    'address1' => $Adress1,
                    'address2' => $Adress2,
                    'postalCode' => $PostalCode,
                    'city' => $City,
                    'lat' => $lat,
                    'lng' => $long
                ]);

            // Step 1
            // Delete this line and go to Step 2
        }

        ///////////////////////////////////////
        /// Contacts
        ///////////////////////////////////////

        // delete old contact info in the DB
        DB::table('contactinfos')
            ->where('persons_id', '=', $id)
            ->delete();


        // write all new mails in the DB
        foreach ($Mails as $mail) {
            if ($mail != null)
                DB::table('contactinfos')->insert(
                    ['value' => $mail, 'contacttypes_id' => 1, 'persons_id' => $id]
                );
        }

        // write all new fixe phone numbers in the DB
        foreach ($FixePhones as $phoneFixe) {
            if ($phoneFixe != null)
                DB::table('contactinfos')->insert(
                    ['value' => $phoneFixe, 'contacttypes_id' => 2, 'persons_id' => $id]
                );
        }

        // write all new phone mobile numbers in the DB
        foreach ($MobilePhones as $mobilePhone) {
            if ($mobilePhone != null)
                DB::table('contactinfos')->insert(
                    ['value' => $mobilePhone, 'contacttypes_id' => 3, 'persons_id' => $id]
                );
        }

        // Step 2
        // Uncomment this line and you are finish
        // Verify the PeopleEdit blade and folow the same procedure
        // }

        return $this->show($id);
    }

    public function getAll(Request $request)
    {
        //flockYear
        if(isset($request->flockYear)){
            return Flock::where("startYear", $request->flockYear)->get()->reduce(function($res, $flock){
                return array_merge($res, $flock->students->toArray());
            }, []);
        }
        //all
        return Person::all();
    }
}
