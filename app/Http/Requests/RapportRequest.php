<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RapportRequest extends FormRequest
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
            'titre_rapport'=>'required | max:20 ',
            'contenu'=>'required ',
            'id_pv'=>'required | integer | exists:pvs,id_pv',
            'codeApogee'=>'required | integer | exists:etudiants,codeApogee'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'error'=>true,
            'message'=> 'Erreur de validation',
            'errorList'=>$validator->errors(),

        ]));
    }
    public function messages()
    {
        return[
            'titre_rapport.required'=>'un titre de rapport doit etre fourni',
            'titre_rapport.max:20'=>'le titre de rapport doit etre au plus 20 character',
            'contenu.required'=>'un contenu de rapport doit etre fourni',
            'codeApogee.required'=>'un code appogée doit etre fourn',
            'codeApogee.integer'=>'le code appogée doit etre entier',
            'codeApogee.exists:etudiants,codeApogee'=>'le code appogée doit etre existe',
            'id_pv.integer'=>'le id de PV doit etre entier',
            'id_pv.exists:pvs,id_pv'=>'le id de PV doit etre existe',

        ];
    }
}
