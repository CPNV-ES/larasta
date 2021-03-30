<?php

namespace App\Http\Controllers;

use App\Evaluation;
use App\EvaluationSection;

class EvaluationGridController extends Controller
{
    public function index() 
    {
        // TODO: Can we do this with Eloquent?
        // Get all unique evaluationSection in the current template evalgrid
        $evaluationSections = [];
        foreach(Evaluation::current_template()->criteriaValue as $criteriaValue) {
            if (!in_array($criteriaValue->criteria->evaluationSection, $evaluationSections)) {
                $evaluationSections[] = $criteriaValue->criteria->evaluationSection;
            }
        }

        usort($evaluationSections, function($a, $b) { return $a->id > $b->id; });

        return view('evaluationgrid.index')->with(compact('evaluationSections'));
    }

    public function create() {
        $evaluationSections = EvaluationSection::all();

        return view('evaluationgrid.create')->with(compact('evaluationSections'));
    }
}
