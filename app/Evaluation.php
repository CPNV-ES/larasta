<?php
/**
 * Evaluation Model
 * 
 * Bastien Nicoud
 * v0.0.1
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    public $timestamps = false;

    /**
     * Authorize mass asignement columns
     *
     * @var array
     */
    protected $fillable = ['visit_id', 'editable'];

    /**
     * Relation with the CriteriaValue model
     */
    public function criteriaValue()
    {
        return $this->hasMany('App\CriteriaValue');
    }

    /**
     * Relation with the Visit model
     */
    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }

    public static function templates()
    {
        return Evaluation::whereNotNull('template_name')->get();
    }

    public static function current_template()
    {
        return Evaluation::templates()->last();
    }
}
