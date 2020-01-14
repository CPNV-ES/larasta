<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lifecycle extends Model
{
    public $timestamps = false;

    /**
     * Relation with the contract state model
     */
    public function contractstatefrom()
    {
        return $this->belongsTo('App\Contractstate', 'from_id');
    }

    public function contractstateto()
    {
        return $this->belongsTo('App\Contractstate', 'to_id');
    }

    public function modifyLifeCycleData($cycle)
    {
        $this->from_id = $cycle->from;
        $this->to_id = $cycle->to;
        $this->save();
    }
}
