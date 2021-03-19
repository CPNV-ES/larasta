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
}
