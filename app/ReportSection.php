<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportSection extends Model
{
    protected $table = 'reportsections';
    protected $fillable = ['name', 'text'];

    public function report()
    {
        return $this->belongsTo(InternshipReport::class);
    }

    /**
     * Create a new section
     * @param $name
     * @param $text
     * @param $reportId
     */
    public function build($name, $text, $reportId)
    {
        $this->name = $name;
        $this->text = $text;
        $this->report_id = $reportId;
        $this->save();
    }

    /**
     * Update the section
     * @param array $name
     * @param array $text
     */
    public function modify($name, $text)
    {
        $this->name = $name;
        $this->text = $text;
        $this->save();
    }
}
