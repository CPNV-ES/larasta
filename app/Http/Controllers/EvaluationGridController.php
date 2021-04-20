<?php

namespace App\Http\Controllers;

use App\Evaluation;
use App\EvaluationSection;

class EvaluationGridController extends Controller
{
    public function index() 
    {
        $evaluationSections = Evaluation::current_template()->sections();
        $templateName = Evaluation::current_template()->template_name;

        return view('evaluationgrid.index')->with(compact('evaluationSections', 'templateName'));
    }

    public function create() {
        $evaluationSections = Evaluation::current_template()->sections();

        return view('evaluationgrid.create')->with(compact('evaluationSections'));
    }
}
