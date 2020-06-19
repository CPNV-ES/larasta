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
    private $classes;

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
        $urlArray = ["http://intranet.cpnv.ch/info/classes.json?api_key=" => "api_key",
                     "http://intranet.cpnv.ch/info/etudiants.json?alter[extra]=current_class&api_key=" => "alter[extra]current_classapi_key",
                     "http://intranet.cpnv.ch/info/enseignants.json?alter[extra]=current_class_masteries&api_key=gifi&signature=40766a439a0d749fa838a44c74341781" => "alter[extra]current_class_masteriesapi_key"
        ];
        
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

            $json = json_decode($response, true);
            if (strpos($url, "classes") !== false)
            {
                $this->classes = $this->getSpecificClasses($json, "#^SI-\w+3\w+$#");
            }
            if (strpos($url, "etudiants") !== false)
            {
                $this->classes = $this->sortStudentsByClasses($json);
            }
            else if (strpos($url, "enseignants") !== false)
            {
                $this->classes = $this->sortTeachersByClasses($json);
            }            
        }

        curl_close($connection);
    }
    function getSpecificClasses($json, $regex)
    {
        $classes=[];

        foreach($json as $key => $value)
        {
            $name = $json[$key]["name"];
            
            //keep only students on SI-C3a, SI-C3b, SI-MI3a, ...
            if(preg_match($regex, $name))
            {
                $classes[$name] = $json[$key];
            }
        }

        return $classes;
    }
    function sortStudentsByClasses($json){
        
        $classes = $this->classes;

        foreach($json as $key => $value)
        {
            $name = $json[$key]["current_class"]["link"]["name"];
            
            //keep only students on SI-C3a, SI-C3b, SI-MI3a, ...
            if(isset($classes[$name]))
            {
                if(!isset($classes[$name]["students"]))
                    $classes[$name]["students"] = [];
                array_push($classes[$name]["students"],$json[$key]);
            }
        }

        return $classes;
    }

    function sortTeachersByClasses($json){
        
        $classes = $this->classes;
        $classNames = [];

        foreach($json as $key => $teacher)
        {
            $isValid = false;
            foreach($json[$key]["current_class_masteries"] as $classKey => $classInformation)
            {
                $classNames[$classKey] = $classInformation["link"]["name"];
                if(isset($classes[$classNames[$classKey]]))
                {
                    $isValid = true;
                }
            }
            
            if($isValid)
            {
                foreach($classNames as $name)
                {
                    if(isset($classes[$name]))
                    {
                        if(!isset($classes[$name]["teacher"]))
                        $classes[$name]["teacher"] = [];
                
                        $classes[$name]["teacher"] = $json[$key];  
                    }
                }
                
            }
        }
        return $classes;
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
        return $this->classes;
    }
}