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

    /**
     * Create a new internship report with its default fields
     * @param $internshipId
     */
    public function build($internshipId)
    {
        $reportStatus = ReportStatus::where('status', 'Brouillon')->first();

        $this->internship_id = $internshipId;
        $this->status_id = $reportStatus->id;
        $this->save();

        $this->storeDefaultFields();

        // Add a remark
        $remark = new Remark();
        $remark->add(5, $internshipId, "Rapport créé");
    }

    /**
     * Store default report fields in the report
     */
    private function storeDefaultFields()
    {
        $this->sections()->createMany([
            ["name" => "Description du contexte de mon stage (entreprise, domaine d'activité, rôles, etc...)"],
            ["name" => "Description de mon plan de carrière"],
            ["name" => "Description de mon équipe (mission, personnes, rôles, organisation, ...)"],
        ]);
    }

    /**
     * Update the status of the report
     * @param $newStatus
     */
    public function updateStatus($newStatus)
    {
        $reportStatus = ReportStatus::where('status', $newStatus)->first();

        $this->status_id = $reportStatus->id;
        $this->save();
    }
}
