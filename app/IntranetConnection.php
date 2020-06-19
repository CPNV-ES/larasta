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
    private $students;
    private $teachers;
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
        //TODO Faire un tableau avec toutes les classe 3ème année,
        //Ensuite, mettre dans ["students"] tous les étudiants de cette classe
        //pareil pour les enseignants, les mettre dans ["teachers"]
        //puis retourner 1 seul tableau contenant toutes les infos utiles
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
                $this->students = $this->sortStudentsByClasses($data);
            }
            else if (strpos($url, "enseignants") !== false)
            {
                $this->teachers = $this->sortTeachersByClasses($data);
            }            
        }

        curl_close($connection);
    }

    function sortStudentsByClasses($json){
        $regex = "#^SI-\w+3\w+$#";
        
        $studentsByClass=[];

        foreach($json as $key => $value)
        {
            $name = $json[$key]["current_class"]["link"]["name"];
            
            //keep only students on SI-C3a, SI-C3b, SI-MI3a, ...
            if(preg_match($regex, $name))
            {
                if(!isset($studentsByClass[$name]))
                    $studentsByClass[$name] = array();
                array_push($studentsByClass[$name],$json[$key]);
            }
        }

        return $studentsByClass;
    }

    function sortTeachersByClasses($json){
        $regex = "#^SI-\w+3\w+$#";
        
        $teachersByClasses=[];
        $className=[];

        foreach($json as $key => $value)
        {
            $isValid = false;
            $classes = $json[$key]["current_class_masteries"];                        
            foreach($classes as $classKey => $classValue)
            {
                //when a teacher as a match with the name of class, we keep
                //the teacher, but we remove all unmatch classes
                $className[$classKey] = array("id" => $classes[$classKey]["link"]["id"],
                                              "name" => $classes[$classKey]["link"]["name"]);
                if(preg_match($regex, $className[$classKey]["name"]))
                    $isValid=true;
                else
                {
                    //remove classes not matching with
                    unset($json[$key]["current_class_masteries"][$classKey]);
                    unset($className[$classKey]);
                }
            }                    
            //keep only teachers on SI-C3a, SI-C3b, SI-MI3a, ...
            if($isValid)
            {
                foreach($className as $classKey => $classData)
                {
                    $name = $classData["name"];
                    $id = $classData["id"];
                    $json[$key]["teacher_id"] = $json[$key]["id"];
                    $json[$key]["class_id"] = $id;
                    $teachersByClasses[$name] = $json[$key];
                    unset($teachersByClasses[$name]["id"]);
                }                
            }        
        }
        return $teachersByClasses;
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
        return $this->students;
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
        return $this->teachers;
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