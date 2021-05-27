<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Visitsstate;

class Visit extends Model implements HasMedia
{
    use InteractsWithMedia;
    
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

    public function hasMedias()
    {
        return $this->getMedia()->isNotEmpty();
    }

    public function getMediaUrl()
    {
        return $this->getMedia()->first()->getUrl();
    }

    public function getGradeAttribute() {
        return round($this->attributes['grade'], 1);
    }
}
