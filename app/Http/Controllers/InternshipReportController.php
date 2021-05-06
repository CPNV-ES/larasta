<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InternshipReport;
use App\Internship;
use App\ReportStatus;

class InternshipReportController extends Controller
{
    public function create($internshipId)
    {
        $report = Internship::findOrFail($internshipId)->report;
        $reportStatus = ReportStatus::where('status', 'Brouillon')->first();

        if (!$report) {
            $newReport = new InternshipReport();
            $newReport->internship_id = $internshipId;
            $newReport->status_id = $reportStatus->id;
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
        $reportStatus = ReportStatus::all();
        return view('internshipreports.show', compact('report', 'reportStatus'));
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

    public function updateStatus(Request $request, $reportId)
    {
        $reportStatus = ReportStatus::where('status', $request->status)->first();
        $report = InternshipReport::find($reportId);

        $report->status_id = $reportStatus->id;
        $report->save();

        return redirect()->route('internshipReport.show', ['id' => $report->id]);
    }
}
