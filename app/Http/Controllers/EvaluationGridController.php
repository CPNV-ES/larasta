<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EvaluationSection;

class EvaluationGridController extends Controller
{
    public function index() 
    {
        $evaluationSections = EvaluationSection::all();

        return view('evaluationgrid.index')->with(compact('evaluationSections'));
    }

    public function create() {
        $evaluationSections = EvaluationSection::all();

        return view('evaluationgrid.create')->with(compact('evaluationSections'));
    }
}
