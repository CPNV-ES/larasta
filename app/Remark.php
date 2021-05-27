<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Remark extends Model
{
    // Let's do without timestamps for now
    public $timestamps = false;

    static $remarkPrefix = 'remark_';

    static $listOfRemarks = [
        "beginDate" => "La date de début de stage, %s, a été modifiée pour %s.",
        "endDate" => "La date de fin de stage, %s, a été modifiée pour %s.",
        "aresp" => "Le Responsable administratif du stage, %s, a été modifié pour %s.",
        "intresp" => "Le responsable du stage, %s, a été modifié pour %s.",
        "stateDescription" => "L'état du stage, %s, a été modifié pour %s.",
        "grossSalary" => "Le salaire du stage, %s, a été modifié pour %s.",
        "externalLogbook" => "Le type de journal de stage a été passé en %s.",
        "internshipDescription" => "La description a été mise à jour.",
        "internId" => "L'étudiant %s a été assigné. (ancien: %s)"
    ];

    /** Getter of the list of custom remarks function callbacks
     * To add a custom remark, define a function in the list that will return the string. The function takes the old and new objects as parameters.
     */
    static function getCustomRemarks(){return [
        "internId" => function (Internship $oldObj, Internship $newObj) {
            if(!$newObj->student){
                return "L'étudiant ".($oldObj->student->fullName ?? "")." a été désassigné";
            }
            return sprintf(self::$listOfRemarks["internId"], $newObj->student->fullName ?? "Non Attribué", $oldObj->student->fullName ?? "Non attribué");
        },
        "externalLogbook" => function(Internship $oldObj, Internship $newObj){
            return sprintf(self::$listOfRemarks["externalLogbook"], $newObj->externalLogbook ? "externe" : "interne");
        }
        // EXEMPLE:
        // "exampleCustomRemark" => function(Person $oldObject, Person $newObject){
        //     return "Nous somme le ".date("d/m/Y")." et le nom de famille de $newObject->fullName a été modifié";
        // }
    ];}

    /**
     * addRemark allows to enter a remark on something. The timestamp put on it is the current time and the person is the current user
     *
     * @param $type which kind of entity is subject to the remark. Refer to database field comments for exact values
     * @param $on the id of the record in its table
     * @param $text the content of the reamrk. No checks are performed, Eloquent does it for us
     */
    public static function add($type, $on, $text)
    {
        $remark = new Remark();
        $remark->remarkType = $type;
        $remark->remarkOn_id = $on;
        $remark->remarkDate = date('Y-m-d H:i:s');
        $remark->remarkText = $text;
        $remark->author = Auth::user()->initials;
        $remark->save();
    }

    public static function addMultipleWithDetails(Request $request, $oldObject, $updatedObject)
    {
        $customRemarks = self::getCustomRemarks();
        $textRegex = "([A-Za-z0-9]+)";
        //search all keys on request (exemple: "id" is $key and 5664 is $data)
        foreach ($request->request as $key => $data) {
            //check if the name of request begin by "remark_"
            if (!preg_match("#^" . self::$remarkPrefix . $textRegex . "$#", $key)) {
                continue;
            }
            $attribute = str_replace(self::$remarkPrefix, '', $key);
            if (empty(self::$listOfRemarks[$attribute])) { //default remark
                $remark = "Les données du champ $attribute ont été modifiées. ";
            } else if (isset($customRemarks[$attribute])) { //custom remark
                $remark = $customRemarks[$attribute]($oldObject, $updatedObject);
            } else { //text remark
                $remark = sprintf(self::$listOfRemarks[$attribute], $oldObject->$attribute, $updatedObject->$attribute);
            }

            if (isset($data))
                $remark .= " Raison: $data";

            self::add(5, $request->id, $remark);
        }
    }
}
