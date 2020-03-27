<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractstate extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'stateDescription',
        'OpenForRenewal'
    ];

    /**
     * Relation with the internship model
     */
    public function internship()
    {
        return $this->hasMany('App\Internship');
    }

    public function modifyContractCellTitle($data)
    {
        foreach($data as $title)
        {
            Contractstate::where('id',$title->id)->update(['stateDescription' => $title->value]);
        }
    }

    public function contractStates()
    {
        return $this->belongsToMany(Contractstate::class,"lifecycles","from_id","to_id");
    }

    public function addEmptyContractState()
    {
        $this->stateDescription = '';
        $this->details = '';
        $this->openForApplication = 0;
        $this->openForRenewal = 0;
        $this->save();
    }
}
