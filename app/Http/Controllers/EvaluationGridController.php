<?php

namespace App\Http\Controllers;

use App\Criteria;
use App\CriteriaValue;
use App\Evaluation;
use App\EvaluationSection;
use Illuminate\Http\Request;

class EvaluationGridController extends Controller
{
    public function index() 
    {
        $evaluationSections = [];
        if(Evaluation::current_template() != null) {
            $evaluationSections = Evaluation::current_template()->sections();
        }
        $templateName = Evaluation::current_template()->template_name ?? "";

        return view('evaluationgrid.index')->with(compact('evaluationSections', 'templateName'));
    }

    public function create() {
        $sections = [];
        // Aggregate data by evaluationSection
        if(Evaluation::current_template() != null) {
            foreach(Evaluation::current_template()->sections() as $section) {
                $sections[$section->id] = [
                    "hasGrade" => $section->hasGrade,
                    "sectionName" => $section->sectionName,
                    "sectionType" => $section->sectionType,
                    "criteria" => $section->criterias->load('criteriaValue')
                ];
            }
        }
        $currentTemplate = [
            "evaluatuationSection" => $sections
        ];

        return view('evaluationgrid.create')->with(compact('currentTemplate'));
    }

    public function storeTemplate(Request $request) {
        $request->validate([
            'name' => 'required|unique:App\Evaluation,template_name',
            'section.*.sectionType' => 'required',
            'section.*.hasGrade' => 'required|boolean',
            'section.*.sectionName' => 'required',
            'section.*.criteria.*.criteriaName' => 'required',
            'section.*.criteria.*.maxPoints' => 'integer',  // not required, only for hasGrade=true
        ]);

        $evaluationTemplate = new Evaluation();
        $evaluationTemplate->template_name = $request->all()["name"];
        $evaluationTemplate->editable = true;
        $evaluationTemplate->visit_id = null;
        $evaluationTemplate->save();

        foreach($request->all()["section"] as $sec) {
            $section = new EvaluationSection();
            $section->sectionName = $sec["sectionName"];
            $section->sectionType = $sec["sectionType"];
            $section->hasGrade = $sec["hasGrade"] == "1";
            $section->save();

            foreach($sec["criteria"] as $crit) {
                $criteria = new Criteria();
                $criteriaValue = new CriteriaValue(); // We need an empty CriteriaValue related to the Criteria to link it to the Evaluation

                $criteria->criteriaName = $crit["criteriaName"];
                $criteria->criteriaDetails = $crit["criteriaDetails"] ?? null;
                $criteria->maxPoints = $crit["maxPoints"] ?? null;
                $criteria->evaluationSection_id = $section->id;
                $criteria->save();

                $criteriaValue->evaluation_id = $evaluationTemplate->id;
                $criteriaValue->criteria_id = $criteria->id;
                $criteriaValue->points = 0;
                $criteriaValue->save();
            }
        }

        return redirect()->route('evaluationgrid.index')->with('message', 'Creation Réussie');
    }
}
