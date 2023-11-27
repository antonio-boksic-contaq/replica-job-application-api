<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email',
            'telephone' => 'required|string|unique:candidates,telephone',
            'note' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'lastname.required' => 'Il campo cognome è obbligatorio.',
            'email.required' => 'Il campo email è obbligatorio.',
            'email.email' => 'Il campo email deve essere un indirizzo email valido.',
            'email.unique' => 'Questo indirizzo email è già stato utilizzato.',
            'telephone.required' => 'Il campo telefono è obbligatorio.',
            'telephone.unique' => 'Questo numero di telefono è già stato utilizzato.',
        ];
    }
}