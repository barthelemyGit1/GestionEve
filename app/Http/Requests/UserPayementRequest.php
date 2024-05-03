<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPayementRequest extends FormRequest
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
            //
                'numeroRecu'=>[
                    'required',
                    'string'
                ],
                'datePaySite'=>[
                    'required',
                ],
                'datePayBanq'=>[
                    'required',
                    
                ],
                'montant'=>[
                    'required',
                    'integer'
                ],
                'image'=>[
                    'required',
                    //'mimes:jpg,jpeg,png'
                ],
                'NCNIB'=>[
                    'required',
                    'string'
                ],
                
        ];
    }
}
