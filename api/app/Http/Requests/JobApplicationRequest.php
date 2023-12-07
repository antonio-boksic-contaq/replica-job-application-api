<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
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
            'candidate_id' => 'required|numeric|gt:0|exists:candidates,id',
            'headquarter_id' => 'required|numeric|gt:0|exists:headquarters,id',
            'job_position_id' => 'required|numeric|gt:0|exists:job_positions,id',
            'acquisition_channel_id' => 'required|numeric|gt:0|exists:acquisition_channels,id',
            'performed' => 'boolean',
            'date' => 'date',
            'rating'=> 'numeric',
            'file'=> 'required|file|mimetypes:application/pdf|max:1000',
        ];

        //levo il required dal file se sto in modifica
        if ($this->request->has('job_application_id')) $rules['file'] =  'file|mimetypes:application/pdf|max:1000';

        return $rules;
    }
    

    public function messages()
    {
        return [
            'candidate_id.required' => 'Il campo candidato è obbligatorio.',
            'candidate_id.numeric' => 'Il valore inserito per il candidato non è valido',
            'candidate_id.gt' => 'Il valore inserito per il candidato non è valido',
            'candidate_id.exists' => 'Il valore inserito per il candidato non è valido',
        
            'headquarter_id.required' => 'Il campo sede è obbligatorio.',
            'headquarter_id.numeric' => 'Il valore inserito per la sede non è valido',
            'headquarter_id.gt' => 'Il valore inserito per la sede non è valido',
            'headquarter_id.exists' => 'Il valore inserito per la sede non è valido',

            'job_position_id.required' => 'E\' obbligatorio inserire la posizione lavorativa',
            'job_position_id.numeric' => 'Il valore inserito per la posizione lavorativa non è valido',
            'job_position_id.gt' => 'Il valore inserito per la posizione lavorativa non è valido',
            'job_position_id.exists' => 'Il valore inserito per la posizione lavorativa non è valido',

            'acquisition_channel_id.required' => 'E\' obbligatorio inserire il canale di acquisizione',
            'acquisition_channel_id.numeric' => 'Il valore inserito per il canale di acquisizione non è valido',
            'acquisition_channel_id.gt' => 'Il valore inserito per il canale di acquisizione non è valido',
            'acquisition_channel_id.exists' => 'Il valore inserito per il canale di acquisizione non è valido',
            
            'performed.boolean' => 'Il valore inserito per l\'avvenuta esecuzione non è valido',
            
            'date.date' => 'Il valore inserito per la data non è valido',
            
            'rating.numeric' => 'Il valore inserito per la valutazione non è valido',
        
            'file.required'=> 'E\' necessario includere un file PDF',
            'file.file'=> 'E\' necessario includere un file PDF',
            'file.mimetypes'=> 'E\' necessario includere un file PDF',
            'file.max'=> 'Il file inserito è troppo grande (max 1MB)',
            
        ];
    }
}