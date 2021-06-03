<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Visitsstate;

class Visit extends Model
{
    public $timestamps = false;
    /**
     * Eloquent will automaticaly convert this colums of the model in Carbon dates
     */
    protected $dates = ['moment', 'maildate'];

    protected $fillable = [
        'moment',
        'number',
        'grade',
        'visitsstates_id',
        'maildate',
    ];
    /**
     * Relation with the Evaluation model
     */
    public function evaluation()
    {
        return $this->hasMany('App\Evaluation');
    }

    /**
     * Relation with the internships model
     */
    public function internship()
    {
        return $this->belongsTo('App\Internship', 'internships_id');
    }

    public function evaluation_open() {
        return $this->visitsstate->slug == 'acc' || $this->visitsstate->slug  == 'eff';
    }

    /**
     * Relation with the visitsstate model
     */
    public function visitsstate()
    {
        return $this->belongsTo('App\Visitsstate','visitsstates_id');
    }

    public function getGradeAttribute() {
        return round($this->attributes['grade'], 1);
    }

    public function getNeededAttentionReasonAttribute() {
        // "Effectuée" and no grade
        if($this->visitsstate->slug === 'eff' && empty($this->grade)) {
            return "La visite est 'Effectuée' mais n'a pas de note !";
        }
        // "Proposée" or "Acceptée" in the past
        elseif(
            ($this->visitsstate->slug === 'pro' || $this->visitsstate->slug === 'acc')
            && !empty($this->moment) && new \DateTime($this->moment) < new \DateTime()
        ) {
          return "La visite est '" . $this->visitsstate->stateName . "' et ne devrait donc pas être dans le passé !";
        }

        return "";
    }

    public function getNeedsAttentionAttribute() {
        return !empty($this->needed_attention_reason);
    }
}
