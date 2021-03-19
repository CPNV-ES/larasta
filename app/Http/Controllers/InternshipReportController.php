<?php

namespace App\Http\Controllers;

use App\InternshipReport;
use App\Internship;

class InternshipReportController extends Controller
{
    public function create($internshipId)
    {
        $report = Internship::findOrFail($internshipId)->report;

        if (!$report) {
            $newReport = new InternshipReport();
            $newReport->internship_id = $internshipId;
            $newReport->save();
        } else {
            abort(404);
        }
    }

    public function show($id)
    {
        $report = InternshipReport::findOrFail($id);
        return view('internshipreports.show', compact('report'));
    }
}
