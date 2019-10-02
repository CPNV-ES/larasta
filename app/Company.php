<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;

    /**
     * Relation with the internships model
     */
    public function internships()
    {
        return $this->hasMany('App\Internship', 'companies_id');
    }

    // TODO : try
    public function contractstates()
    {
        return $this->belongsToMany('App\Contractstate', 'internships',
            'companies_id', 'contractstate_id');
    }

    // TODO : try
    public function confirmedOrReconductedContractstate()
    {
        return $this->contractstates()
            ->where('contractstates.stateDescription','Confirmé')
            ->orWhere('contractstates.stateDescription','Reconduit')
            ->whereYear('internships.beginDate', '=', date('Y'));
        // or wherePivot, for the whereYear
    }


}
