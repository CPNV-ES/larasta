<?php
/*
 * Title : IntranetConnection.php
 * Author : Steven Avelino
 * Creation Date : 20 December 2017
 * Modification Date : 23 January 2018
 * Version : 1.0
 * Model to get informations from the intranet API
*/

namespace App;

class IntranetConnection
{
    /**
     * Class attributes
     * $studentsList : This attribute will contain the list of students returned by the intranet
     * $teachersList : This attribute will contain the list of teachers returned by the intranet
     * $classesList : This attribute will contain the list of classes returned by the intranet
     */
    private $studentsList;
    private $teachersList;
    private $classesList;

    /**
     * generateSignature
     * 
     * This method will take the query parameters and then create a signature after hashing it with MD5 to be later sent to the intranet.
     * 
     * @param $params Parameters for the query that will be then requested to the intranet
     * @return string
     */
    public function generateSignature($params)
    {
        $queryParams = $params . getenv('API_KEY') . getenv('API_SECRET');
        $signature = md5($queryParams);

        return $signature;
    }

    /**
     * __construct
     * 
     * The construct method of the class.
     * It uses curl to get JSON from the intranet.
     * The URLs are already addressed, since we know what type of datas we want to get from the intranet.
     * When the curl request is done, it puts the returned datas in the right attribute and closes the curl connection.
     * 
     * 
     * @return array
     */
    public function __construct()
    {
        /// Create an associative array with the url and their parameters to create the signature
        $urlArray = ["http://intranet.cpnv.ch/info/etudiants.json?alter[extra]=current_class&api_key=" => "alter[extra]current_classapi_key",
                     //"http://intranet.cpnv.ch/info/enseignants.json?api_key=" => "api_key",
                     "http://intranet.cpnv.ch/info/enseignants.json?alter[extra]=current_class_masteries&api_key=gifi&signature=40766a439a0d749fa838a44c74341781",
                     "http://intranet.cpnv.ch/info/classes.json?api_key=" => "api_key"];

        $connection = curl_init();

        foreach ($urlArray as $url => $urlSign)
        {
            curl_setopt_array($connection, [
                CURLOPT_URL => $url . getenv('API_KEY') . "&signature=" . $this->generateSignature($urlSign),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "cache-control: no-cache"
                ],
            ]);

            $response = curl_exec($connection);

            $data = json_decode($response, true);
            if (strpos($url, "etudiants") !== false)
            {
                foreach($data as $keys => $value)
                {
                    $name = $data[$keys]["current_class"]["link"]["name"];
                    //keep only students on SI-C3a, SI-C3b, SI-MI3a, ...
                    if(!preg_match("#^SI-\w+3\w+$#", $name))
                        unset($data[$keys]);
                }
                array_values($data);

                $this->students = $data;
            }
            else if (strpos($url, "enseignants") !== false)
            {
                foreach($data as $keys => $value)
                {
                    $isValid = false;
                    $classes = $data[$keys]["current_class_masteries"];
                    foreach($classes as $keys => $value)
                    {
                        if(preg_match("SI-\w+3\w+", $classes["link"]["name"]))
                            $isValid=true;
                    }                    
                    //keep only students on SI-C3a, SI-C3b, SI-MI3a, ...
                    if(!$isValid)
                        unset($data[$keys]);                    
                }
                array_values($data);
                $this->teachers = $data;
            }
            else if (strpos($url, "classes") !== false)
            {
                foreach($data as $keys => $value)
                {
                    $name = $data[$keys]["name"];
                    //keep only students on SI-C3a, SI-C3b, SI-MI3a, ...
                    if(!preg_match("SI-\w+3\w+", $name))
                        unset($data[$keys]);
                }
                array_values($data);
                $this->classes = $data;
            }
            
            dd("teachers",$this->teachersList, "students", $this->studentsList);
        }

        curl_close($connection);
    }

    /**
     * getStudents
     * 
     * Getter for the attribute $studentsList
     * 
     * @return array
     */
    public function getStudents()
    {
        return $this->studentsList;
    }

    /**
     * getTeachers
     * 
     * Getter for the attribute $teachersList
     * 
     * @return array
     */
    public function getTeachers()
    {
        return $this->teachersList;
    }

    /**
     * getClasses
     * 
     * Getter for the attribute $classesList
     * 
     * @return array
     */
    public function getClasses()
    {
        return $this->classesList;
    }
}