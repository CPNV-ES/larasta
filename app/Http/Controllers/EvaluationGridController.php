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
        $sections = [];
        // Aggregate data by evaluationSection
        foreach(Evaluation::current_template()->sections() as $section) {
            $sections[$section->id] = [
                "hasGrade" => $section->hasGrade,
                "sectionName" => $section->sectionName,
                "sectionType" => $section->sectionType,
                "criteria" => $section->criterias->load('criteriaValue')
            ];
        }

        $currentTemplate = [
            "evaluatuationSection" => $sections
        ];

        return view('evaluationgrid.create')->with(compact('currentTemplate'));
    }
}
