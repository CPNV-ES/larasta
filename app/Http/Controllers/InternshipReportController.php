<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InternshipReport;
use App\Internship;
use App\ReportStatus;
use Illuminate\Support\Facades\Auth;

class InternshipReportController extends Controller
{
    public function create($internshipId)
    {
        $internship = Internship::findOrFail($internshipId);

        if (Auth::user()->id == $internship->intern_id)
        {
            if (Internship::find($internshipId)->report)
            {
                abort(404);
            }
            else
            {
                $report = new InternshipReport();
                $report->build($internshipId);

                return redirect()->route('internshipReport.show', ['id' => $report->id]);
            }
        }
        else 
        {
            abort(404);
        }
    }

    public function show($id)
    {
        $report = InternshipReport::findOrFail($id);
        $reportStatus = ReportStatus::all();

        return view('internshipreports.show', compact('report', 'reportStatus'));
    }

    public function update(Request $request, $reportId)
    {
        $report = InternshipReport::findOrFail($reportId);

        if (Auth::user()->id == $report->internship->intern_id) 
        {
            dd("ok");
            $report->updateStatus($request->status);
    
            return redirect()->route('internshipReport.show', ['id' => $report->id]);
        }
        else
        {
            abort(404);
        }    
    }
}
