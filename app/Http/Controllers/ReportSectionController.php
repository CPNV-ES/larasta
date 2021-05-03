<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InternshipReport;
use App\ReportSection;

class ReportSectionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
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
        $reportSection->name = $request->title;
        $reportSection->text = $request->description;
        $reportSection->save();

        return redirect()->route('internshipReport.show', ['id' => $reportSection->report_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
