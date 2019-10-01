<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;      // For Get/insert/update record in DB
use CPNVEnvironment\Environment;        // For get the information of current user

/// Author : Kevin Jordil 2018

/// This controller manage all functions needed to display TravelTime
/// Work only for 10 persons max

class TravelTimeController extends Controller
{
    protected $message; // a message to display - if defined - in views
    protected $unknowChar = "?"; // unknow char is when the time is unknow, define this char
    protected $limitElementGoogle = 10; // Maximum d'element requete google
    protected $transportMode = "transit"; // transport mode for Google API request (transit, driving, walking or bicycling)

    // CSS color class
    protected $cssClass1 = "color1";
    protected $cssClass2 = "color2";
    protected $cssClass3 = "color3";
    protected $cssClass4 = "color4";
    protected $cssClass5 = "color5";

    /// Calculate the traveltime for a class and add it to Database
    public function calculate($flockId)
    {

        $companies = $this->getCompaniesDB(); // Get internships with companies name from DB
        $persons = $this->getPersonsDB($flockId); // Get persons from DB
        $persons = $persons->merge($this->getPersonsDB($flockId + 1));

        $origins = $this->splitArray($companies, $this->limitElementGoogle);
        $destinations = $this->splitArray($persons, $this->limitElementGoogle);

        $nbPersonBlocks = floor($persons->count() / $this->limitElementGoogle);
        $nbCompanyBlocks = floor($companies->count() / $this->limitElementGoogle);

        error_log($persons->count()." persons, ".$companies->count()." companies");
        for ($cBlock = 0; $cBlock <= $nbCompanyBlocks; $cBlock++)
            for ($pBlock = 0; $pBlock <= $nbPersonBlocks; $pBlock++)
            {
                error_log("Block $cBlock,$pBlock");
                $maxPIndex = min(($pBlock+1)*$this->limitElementGoogle-1,$persons->count()-1);
                $maxCIndex = min(($cBlock+1)*$this->limitElementGoogle-1,$companies->count()-1);
                error_log("Persons ".($pBlock*$this->limitElementGoogle)." to $maxPIndex");
                error_log("Company ".($cBlock*$this->limitElementGoogle)." to $maxCIndex");
            }
        return "calculé";

        // TODO: make actual calls

        $travelTimes = $this->getTravelTime($this->transportMode, $origins, $destinations); // Get info with Google
        $error = $this->checkGoogleAPI($travelTimes); // Check if Google result is OK or if get error

        if ($error != null)
        { //if we get error return page with Google message
            return view('traveltime/traveltime')->with(
                [
                    "message" => $error,
                    "error" => true
                ]
            );
        }

        $times = $this->extractTimes($travelTimes, $origins, $destinations); // extract times from Google result
        //$this->addDataDB($times, $companies, $persons); // add extrated data to DB

        $colors = $this->colorTimes($times); // define class color for times

        $message = "Classe calculée !"; // Define display message

        return view('traveltime/traveltime')->with(
            [
                "companies" => $companies,
                "persons" => $persons,
                "times" => $times,
                "colors" => $colors,
                "flockId" => $flockId,
                "message" => $message,
                "error" => false
            ]
        );
    }

    /// load travelTime data from DB
    public function load($flockId)
    {

        $companies = $this->getCompaniesDB(); // Get internships with companies name from DB
        $persons = $this->getPersonsDB($flockId); // Get persons from DB
        $persons = $persons->merge($this->getPersonsDB($flockId + 1));

        $times = array(); // Create empty array for add element in loop

        // Get travelTime from DB and add it t times array
        foreach ($companies as $company)
        {
            foreach ($persons as $person)
            {

                $traveltime = $this->getTravelTimeDB($person->id, $company->internships_id);
                if (isset($traveltime[0]))
                {
                    array_push($times, $traveltime[0]->travelTime);
                } else
                {
                    array_push($times, $this->unknowChar);
                }
            }
        }


        $colors = $this->colorTimes($times); // define class color for times
        $message = "Chargement réussi";

        return view('traveltime/traveltime')->with(
            [
                "companies" => $companies,
                "persons" => $persons,
                "times" => $times,
                "colors" => $colors,
                "flockId" => $flockId,
                "message" => $message,
                "error" => false
            ]
        );

    }

    /// Get Travel by Google API
    /// Return an array with all JSON from google API Distance matrix
    public function getTravelTime($mode, $origins, $destinations)
    {


        // GET Date of tommorow 8 o'clock in seconds
        $timestamp = $this->getTimestamp();


        //////////////////////////Do requests at Google API and create an array with all datas///////////////////////////
        $travelTime = array();
        foreach ($destinations as $destination)
        {
            foreach ($origins as $origin)
            {
                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $origin . "&destinations=" . $destination . "&mode=" . $mode . "&arrival_time=" . $timestamp . "&key=" . $_ENV['API_GOOGLE_MAP'];
                $json = file_get_contents($url);
                $actualTravel = json_decode($json, true);
                array_push($travelTime, $actualTravel);
                sleep(1);
            }
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return $travelTime;


    }

    /// Split array for Google API limit
    public function splitArray($array, $nb)
    {
        $iteration = 0;
        $res = count($array) / $nb;
        $it = null;
        if (is_float($res))
        {
            $it = intval($res) + 1;
        } else
        {
            $it = $res;
        }

        $result = array_fill(0, $it, NULL);

        for ($j = 0; $j < $it; $j++)
        {
            for ($i = $iteration * $nb; $i < $iteration * $nb + $nb; $i++)
            {
                if ($i > count($array) - 1)
                {
                    break;
                } else
                {
                    $result[$iteration] .= $array[$i]->lat . "," . $array[$i]->lng . "|";
                }
            }
            $iteration++;
        }
        return $result;

    }

    /// Extract times from PHP array and return an array
    /// Work only when we have 10 persons
    public function extractTimes($travelTimes, $origins, $destinations)
    {
        $times = array();


        // Order array
        $tempCol = collect($travelTimes);
        $travelTimes = $tempCol->sortByDesc('origin_addresses')->all();


        // Go in the json result take all the times and put it in an array
        // Not work with more than 10 persons
        $alreadyChecked = array();
        foreach ($travelTimes as $key => $travelTime)
        {
            if (!in_array($key, $alreadyChecked))
            {

                foreach ($travelTime["rows"] as $row)
                {
                    foreach ($row["elements"] as $element)
                    {
                        if (isset($element["duration"]["value"]))
                        {
                            array_push($times, round($element["duration"]["value"] / 60));
                        } else
                        {
                            array_push($times, $this->unknowChar);
                        }
                    }
                }

                if (count($travelTime["origin_addresses"]) < $this->limitElementGoogle)
                {

                    for ($i = $key + 1; $i < count($travelTimes); $i++)
                    {
                        if (count($travelTimes[$i]["destination_addresses"]) == count($travelTime["origin_addresses"]))
                        {
                            array_push($alreadyChecked, $i);

                            foreach ($travelTimes[$i]["rows"] as $row)
                            {
                                foreach ($row["elements"] as $element)
                                {
                                    if (isset($element["duration"]["value"]))
                                    {
                                        array_push($times, round($element["duration"]["value"] / 60));
                                    } else
                                    {
                                        array_push($times, $this->unknowChar);
                                    }
                                }
                            }
                        }
                    }
                }

            }
        }

        return $times;
    }

    /// Check if we have a problem with request
    /// the most popular message it's daily quota end
    public function checkGoogleAPI($travelTimes)
    {
        if (isset($travelTimes[count($travelTimes) - 1]["error_message"]))
        {
            return $travelTimes[count($travelTimes) - 1]["error_message"];
        }
        return null;
    }

    /// Define wich color class the time have
    /// the function take the higher number and define range for every color
    /// Return a colors array with same id as $times
    public function colorTimes($times)
    {
        $maxValue = max($times);
        $ratio = $maxValue / 5;
        $range1 = $ratio * 1;
        $range2 = $ratio * 2;
        $range3 = $ratio * 3;
        $range4 = $ratio * 4;
        $range5 = $ratio * 5;
        $colors = $times;
        foreach ($times as $key => $time)
        {
            try
            {
                switch (true)
                {
                    case $time == 0:
                        $colors[$key] = "";
                        break;
                    case $time < $range1:
                        $colors[$key] = $this->cssClass1;
                        break;
                    case $time < $range2:
                        $colors[$key] = $this->cssClass2;
                        break;
                    case $time < $range3:
                        $colors[$key] = $this->cssClass3;
                        break;
                    case $time < $range4:
                        $colors[$key] = $this->cssClass4;
                        break;
                    case $time <= $range5:
                        $colors[$key] = $this->cssClass5;
                        break;
                    default:
                        $colors[$key] = "";
                        break;
                }
            } catch (\Exception $e)
            {
            }
        }
        return $colors;

    }

    /// Return the timestamp (time in seconds from 1 january 1970) from the next open day at 8 o'clock
    public function getTimestamp()
    {
        $datetoday = date('Y-m-d', time());
        $date = date('Y-m-d H:i:s', strtotime($datetoday . ' +1 Weekday +7 hours'));
        return strtotime($date);
    }

    /// Add Data to Database
    /// By companies and persons, add the good times in DB
    public function addDataDB($times, $companies, $persons)
    {
        $i = 0;
        // Check if an record exist if yes update it otherwise create it
        foreach ($companies as $company)
        {
            foreach ($persons as $person)
            {

                $exists = DB::table('wishes')
                    ->where('wishes.persons_id', $person->id)
                    ->where('wishes.internships_id', $company->internships_id)
                    ->first();

                if ($times[$i] != $this->unknowChar)
                {
                    $this->insertUpdateDB($times[$i], $exists, $company, $person);
                } else
                {
                    $this->insertUpdateDB($this->unknowChar, $exists, $company, $person);
                }
                $i++;
            }
        }
    }

    /// Check if record exist if yes update otherwise insert it
    public function insertUpdateDB($traveltime, $exist, $company, $person)
    {
        if (!$exist)
        {
            DB::table('wishes')->insert([
                ['internships_id' => $company->internships_id,
                    'persons_id' => $person->id,
                    'rank' => 0,
                    'workPlaceDistance' => 0,
                    'travelTime' => $traveltime,
                    'application' => 1
                ]
            ]);
        } else
        {
            DB::table('wishes')
                ->where('wishes.persons_id', $person->id)
                ->where('wishes.internships_id', $company->internships_id)
                ->update(['wishes.travelTime' => $traveltime]);
        }

    }

    /// Get companies infos from Database
    public function getCompaniesDB()
    {
        $companies = DB::table('companies')
            ->join('internships', 'internships.companies_id', '=', 'companies.id')
            ->join('locations', 'location_id', '=', 'locations.id')
            ->where('companies.mptOK', 1)
            ->whereYear('internships.beginDate', '=', date('Y'))
            ->orderBy('companies.id', 'asc')
            ->select('internships.id as internships_id', 'companies.id', 'companies.companyName', 'locations.lat', 'locations.lng')
            ->get();

        return $companies;
    }

    /// Get persons infos from Database
    public function getPersonsDB($flock_id)
    {
        $persons = DB::table('persons')
            ->join('locations', 'location_id', '=', 'locations.id')
            ->join('flocks', 'persons.flock_id', '=', 'flocks.id')
            ->whereNotNull('locations.lat')
            ->whereNotNull('locations.lng')
            ->where('persons.flock_id', $flock_id)
            ->orderBy('persons.id', 'asc')
            ->select('persons.id', 'persons.initials', 'locations.lat', 'locations.lng')
            ->get();
        return $persons;
    }

    /// Get wishes from Database
    public function getTravelTimeDB($idPerson, $idInternships)
    {
        $travelTimes = DB::table('wishes')
            ->where('wishes.persons_id', $idPerson)
            ->where('wishes.internships_id', $idInternships)
            ->select('wishes.travelTime')
            ->get();
        return $travelTimes;
    }

    /// Get the actual connected user
    private function getCurrentUser($personId)
    {
        $persons = DB::table('persons')
            ->where('persons.id', $personId)
            ->whereNotNull('persons.initials')
            ->select('persons.id', 'persons.initials', 'persons.flock_id', 'persons.role')
            ->first();
        error_log(print_r($persons, 1));
        return $persons;
    }

}
