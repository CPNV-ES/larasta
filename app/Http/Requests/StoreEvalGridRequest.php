<?php
/**
 * StoreEvalGridRequest
 * 
 * This class contains custom request for validating evalgrid update requests
 * He authorise the request and define the rules
 * 
 * Bastien Nicoud
 * v1.0.0
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use CPNVEnvironment\Environment;
use App\Evaluation;

// custom validation rules
use App\Rules\MaxGridGrade;
use App\Rules\MinRequiredLevel;

class StoreEvalGridRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->role > 0) {
            // If the user is a teacher or admin the request is authored
            return true;
        } elseif (Auth::user()->role == 0) {
            // If the user is a studend, we check if is this eval
            // Check if this eval belongs to this user
            if (Evaluation::find($this->route('gridID'))->visit->internship->intern_id == Auth::user()->person->id) {
                return true;
            }
        }

        // by default not authored
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Validates all the specification fields
            '*.specs' => ['nullable', 'max:500', new MinRequiredLevel(1)],
            // Validates all the master comment fields
            '*.mComm' => ['nullable', 'max:500', new MinRequiredLevel(1)],
            // Validates all the student comments
            '*.sComm' => ['nullable', 'max:500', new MinRequiredLevel(0)],
            // Validates all the grades
            '*.grade' => ['nullable', 'numeric', new MaxGridGrade, new MinRequiredLevel(1)],
            // Check the submit field is present
            'submit' => ['required', new MinRequiredLevel(1, 'checkout')]
        ];
    }
}
