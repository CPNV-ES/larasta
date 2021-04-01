<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternshipReport extends Model
{
    protected $table = 'internshipreports';

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }

    public function sections()
    {
        return $this->hasMany('App\ReportSection', 'report_id');
    }

    public function status()
    {
        return $this->belongsTo(ReportStatus::class);
    }
}
