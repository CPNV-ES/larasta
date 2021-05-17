<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportStatus extends Model
{
    protected $table = 'reportstatus';

    public function reports()
    {
        return $this->hasMany('App\InternshipReport', 'status_id');
    }
}
