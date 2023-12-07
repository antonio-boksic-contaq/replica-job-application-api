<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class JobPositionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [];
        
        $rules['description'] = $this->request->has('job_position_id') ? 
        [
            'required',
            Rule::unique('job_positions')->ignore($this->request->get('job_position_id'))
        ] :
        'required|unique:job_positions';

        if($this->request->has('questions')) {
            $rules['questions.*'] = 'exists:questions,id';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'description.required' => 'La descrizione è obbligatoria',
            'description.unique' => 'Hai già inserito una competenza con questa descrizione',
            'questions.*' => 'La domanda selezionata non è valida',
        ];
    }
}