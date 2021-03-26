<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportSection extends Model
{
    protected $table = 'reportsections';

    public function report()
    {
        return $this->belongsTo(InternshipReport::class);
    }
}
