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

    /**
     * Returns a collection of this Evaluation's EvaluationSections
     *
     * @return EvaluationSection[] A collection of this Evaluation's EvaluationSections
     */
    public function sections() {
        return $this->criteriaValue->unique('criteria.evaluationSection')->pluck('criteria.evaluationSection');
    }

    /**
     * Checks whether or not the Evaluation is fully filled, that is
     * if all of its required criterias are filled
     *
     * @see CriteriaValue::are_all_required_fields_filled()
     * @return boolean true if the Evaluation is considered fully filled, false otherwise
     */
    public function is_fully_filled() {
        foreach($this->criteriaValue()->get() as $cv) {
            if(!$cv->are_all_required_fields_filled())
                return false;
        }

        return true;
    }

    /**
     * Returns all templates Evaluations
     *
     * @return Relation A collection of template Evaluations
     */
    public static function scopeTemplates()
    {
        return Evaluation::whereNotNull('template_name');
    }

    /**
     * Returns the currently enabled template Evaluation
     *
     * @return Evaluation The currently enabled template Evaluation
     */
    public static function current_template()
    {
        return Evaluation::templates()->latest('id')->first();
    }
}
