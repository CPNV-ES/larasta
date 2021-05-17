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

    public function sections() {
        $evaluationSections = [];
        foreach($this->criteriaValue as $criteriaValue) {
            if (!in_array($criteriaValue->criteria->evaluationSection, $evaluationSections)) {
                $evaluationSections[] = $criteriaValue->criteria->evaluationSection;
            }
        }

        usort($evaluationSections, function($a, $b) { return $a->id > $b->id; });

        return $evaluationSections;
    }

    public static function scopeTemplates()
    {
        return Evaluation::whereNotNull('template_name');
    }

    public static function current_template()
    {
        return Evaluation::templates()->latest('id')->first();
    }
}
