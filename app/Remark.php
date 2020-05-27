<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Remark extends Model
{
    // Let's do without timestamps for now
    public $timestamps = false;
    
    static $listOfRemarks = [
        "remark_beginDate" => "La date de début de stage, %s, a été modifiée pour %s.",
        "remark_endDate" => "La date de fin de stage, %s, a été modifiée pour %s.",
        "remark_aresp" => "Le Responsable administratif du stage, %s, a été modifié pour %s.",
        "remark_intresp" => "Le responsable du stage, %s, a été modifié pour %s.",
        "remark_stateDescription" => "L'état du stage, %s, a été modifié pour %s.",
        "remark_grossSalary" => "Le salaire du stage, %s, a été modifié pour %s.",
        "remark_externalLogbook" => "Le type de journal de stage, %s, a été modifié pour %s.",
        "remark_internshipDescription" => "La description a été mise à jour."
    ];

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
        $remark->author = Auth::user()->person->initials;
        $remark->save();
    }

    public static function addMultipleWithDetails(Request $request, $oldObject, $updatedObject)
    {
        $textRegex = "([A-Za-z0-9]+)";
        //search all keys on request (exemple: "id" is $key and 5664 is $data)
        foreach ($request->request as $key => $data) {
            //check if the name of request begin by "remark_"
            if (!preg_match("#^remark_$textRegex$#", $key)) {
                continue;
            }
            if(empty(self::$listOfRemarks[$key]))
                $remark = "Les données du champ " . substr($key, strpos($key, "_") + 1) . " ont été modifiées. ";
            else
            {                
                $attribute = str_replace('remark_', '', $key);
                $remark = sprintf( self::$listOfRemarks[$key], $oldObject->$attribute, $updatedObject->$attribute);
            }

            if (isset($data))
                $remark .= " Raison: $data";

            self::add(5, $request->id, $remark);
        }
    }
}
