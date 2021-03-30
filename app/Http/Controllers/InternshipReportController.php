<?php

namespace App\Http\Controllers;

use App\InternshipReport;
use App\Internship;
use App\ReportSection;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class InternshipReportController extends Controller
{
    public function create($internshipId)
    {
        $report = Internship::findOrFail($internshipId)->report;

        if (!$report) {
            $newReport = new InternshipReport();
            $newReport->internship_id = $internshipId;
            $newReport->save();

            $this->storeDefaultFields($newReport->id);

            return redirect()->route('internshipReport.show', ['id' => $newReport->id]);
        } else {
            abort(404);
        }
    }

    public function show($id)
    {
        $report = InternshipReport::findOrFail($id);
        return view('internshipreports.show', compact('report'));
    }

    private function storeDefaultFields($reportId)
    {
        $report = InternshipReport::find($reportId);
        $report->sections()->createMany([
            ["name" => "Description du contexte de mon stage (entreprise, domaine d'activité, rôles, etc...)"],
            ["name" => "Description de mon plan de carrière"],
            ["name" => "Description de mon équipe (mission, personnes, rôles, organisation, ...)"],
        ]);
    }
}
