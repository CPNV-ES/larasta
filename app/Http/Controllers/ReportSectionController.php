<?php

namespace App\Http\Controllers;

use App\InternshipReport;
use Illuminate\Http\Request;
use App\ReportSection;
use Illuminate\Support\Facades\Auth;

class ReportSectionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $reportId)
    {
        $report = InternshipReport::find($reportId);

        if (Auth::user()->id == $report->internship->intern_id) 
        {
            $reportSection = new ReportSection;
            $reportSection->name = $request->title;
            $reportSection->text = $request->description;
            $reportSection->report_id = $reportId;
            $reportSection->save();
    
            return redirect()->route('internshipReport.show', ['id' => $reportId]);
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reportSection = ReportSection::find($id);

        if (Auth::user()->id == $reportSection->report->internship->intern_id) 
        {
            $reportSection->name = $request->title;
            $reportSection->text = $request->description;
            $reportSection->save();
    
            return redirect()->route('internshipReport.show', ['id' => $reportSection->report_id]);
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reportSection = ReportSection::find($id);

        if (Auth::user()->id == $reportSection->report->internship->intern_id) 
        {
            $reportSection->delete();

            return redirect()->route('internshipReport.show', ['id' => $reportSection->report_id]);
        }
        else
        {
            abort(404);
        }
    }
}
