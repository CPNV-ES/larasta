<?php

namespace App;

class IntranetConnection
{
    private $classes;
    private $url;

    function __construct()
    {
        $this->url= "http://intranet.cpnv.ch/";
    }
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

    //call the api and return a json
    private function getInformation($url,$urlSign)
    {
        $connection = curl_init();
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
        
        $json = json_decode(curl_exec($connection), true);

        return $json;
    }

    function searchPerson($friendlyId){
        
        $url = $this->url."people/$friendlyId.json?api_key=";
        $urlSign = "api_key";

        $json = $this->getInformation($url,$urlSign);
    }

    function searchTeacher($friendlyId)
    {        
        $url = $this->url."people/$friendlyId.json?alter[extra]=current_class_masteries&api_key=";
        $urlSign = "alter[extra]current_class_masteriesapi_key";
        return $this->getInformation($url,$urlSign);
    }

    function searchStudent($friendlyId)
    {
        $url = $this->url."people/$friendlyId.json?alter[extra]=current_class&api_key=";
        $urlSign = "alter[extra]current_classapi_key";
        return $this->getInformation($url,$urlSign);
    }

    /**
     * Regex is used to get specific classes. when we have classes, we sort student and teachers on specific classes.
     * 
     * @return Classes Array with student and the master of the class of each class
     */
    public function getSpecificClassesWithStudentsAndTeacher($regex)
    {
        /// Create an associative array with the url and their parameters to create the signature
        $urlArray = [ $this->url."info/classes.json?api_key=" => "api_key",
                     $this->url."info/etudiants.json?alter[extra]=current_class&api_key=" => "alter[extra]current_classapi_key",
                     $this->url."info/enseignants.json?alter[extra]=current_class_masteries&api_key=" => "alter[extra]current_class_masteriesapi_key"
        ];
        
        $connection = curl_init();
        foreach ($urlArray as $url => $urlSign)
        {
            $json = $this->getInformation($url,$urlSign);

            if (strpos($url, "classes") !== false)
            {
                $this->classes = $this->getSpecificClasses($json, $regex);
            }
            else if (strpos($url, "etudiants") !== false)
            {
                $this->classes = $this->sortStudentsByClasses($json);
            }
            else if (strpos($url, "enseignants") !== false)
            {
                $this->classes = $this->sortTeachersByClasses($json);
            }            
        }

        curl_close($connection);
        return $this->classes;
    }

    private function getSpecificClasses($json, $regex)
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

    private function sortStudentsByClasses($json){
        
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

    private function sortTeachersByClasses($json){
        
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

}