<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SouscriptionsFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'personnel_id'=>[
                'required',
                
            ],
            'email'=>[
                'required',
            ],
           
            'modePayement'=>[
                'required',
                'string'
            ],
            'dateDebut'=>[
                'required',
               
            ],
            'dateFin'=>[
                'required',
            ],
            'image'=>[
                'nullable',
                
            ],
            'montantTotal'=>[
                'required',
                'string'
            ],
            
            'typeProduit'=>[
                'required',
                'string'
            ],
            'site'=>[
                'required',
                'string'
            ],
            'typeLogement'=>[
                'required',
                'string'
            ],
            'superficieLogement'=>[
                'required',
                'string'
            ],
        ];
    }
}
