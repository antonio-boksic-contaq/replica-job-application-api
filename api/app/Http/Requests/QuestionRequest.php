<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [
        ];

        $rules["description"] =  $this->request->has('question_id') ? 
        [
            'required',
            Rule::unique('questions')->ignore($this->request->get('question_id'))
        ] :
        'required|unique:questions';

        return $rules;
    }

    public function messages()
    {
        return [
            'description.required' => 'Il campo descrizione è obbligatorio.',
        ];
    }
}