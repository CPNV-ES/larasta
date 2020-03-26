<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'day' => 'required|date',
            'hour' => 'required|date_format:H:i',
            'number' => 'required|integer',
            'grade' => 'required|numeric|min:1|max:6',
            'visitsstates_id' => 'required|integer',
        ];
    }
}
