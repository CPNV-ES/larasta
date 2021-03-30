<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportSection extends Model
{
    protected $table = 'reportsections';
    protected $fillable = ['name'];

    public function report()
    {
        return $this->belongsTo(InternshipReport::class);
    }
}
