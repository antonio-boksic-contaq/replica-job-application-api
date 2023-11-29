<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Headquarter;
use Symfony\Contracts\Service\Attribute\Required;

class HeadquarterRequest extends FormRequest
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
        dd(Headquarter::where());

        $rules = [
            'country' => 'required|string|max:255',
            'city' => 'required_without:foreign_city|prohibits:foreign_city|string|max:255',
            'foreign_city'=> 'required_without:city|prohibits:city|string|max:255',
        ];
        
            if ($this->request->has('headquarter_id')) {
                //(headquarter_id viene da un campo hidden nel form di modifca del frontend, ed equiuvale all'id del record)
                $rules['name'] = ['required' , 'string', 'max:255' ,Rule::unique('headquarters')->ignore($this->request->get('headquarter_id'))];
                
                $rules['is_main'] = Rule::prohibitedIf( fn () => 
                $this->request->get('is_main') == 1
                &&
                Headquarter::where('is_main',1)->where('id', '<>', $this->request->get('headquarter_id'))->count() > 0
                ); 
            } else {
                $rules['name'] = 'required|string|max:255|unique:headquarters';
                //nel db deve esserci solo un record che abbia is_main=1 
                //quindi devo proibire l'inserimento di un record che abbia campo is_main=1 se già ne ho un'altro nel db.
                $rules['is_main'] = Rule::prohibitedIf( fn () => 
                $this->request->get('is_main') == 1
                &&
                Headquarter::where('is_main',1)->count() > 0
                ); 
            }
            //nella request di mattia trovo anche job_positions ma nella parte di codice che sto replicando questa tabella non l'ho inclusa.

        

        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.unique' => 'Esiste già una sede con questo nome',
            'country.required' => 'Il campo country è obbligatorio.',
            'city.required_without' => 'Non è stata selezionata alcuna città',
            'city.prohibits' => 'Non è possibile inserire più di una città',
            'foreign_city.required_without' => 'Non è stata selezionata alcuna città',
            'foreign_city.prohibits' => 'Non è possibile inserire più di una città',
            'is_main.prohibited' => 'Esiste già una sede principale'
        ];
    }
}