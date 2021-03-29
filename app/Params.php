<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Params extends Model
{
    protected $primaryKey = 'param_id';
    public $timestamps = false;
    protected $fillable = [
        'paramValueDate',
        'paramName',
    ];
    
    //
    /**
     * Get the param from the name
     * @param name mixed value
     * 
     * @author Benjamin Delacombaz
     */
    public static function getParamByName($name)
    {
        $params = Params::where('paramName', $name)
        ->first();
        return $params;
    }

    /**
     * Returns the type of the currently stored parameter value
     *
     * @return string "int", "text", "date" depending on the Param's value, or "none" if the Param has no value
     */
    public function getValueTypeAttribute() {
        if(isset($this->paramValueInt)) {
            return "int";
        }
        elseif(isset($this->paramValueText)) {
            return "text";
        }
        elseif(isset($this->paramValueDate)) {
            return "date";
        }
        else {
            return "none";
        }
    }
}
