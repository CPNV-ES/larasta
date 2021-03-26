<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function store(Request $request, $id)
    {
        
    }
}
