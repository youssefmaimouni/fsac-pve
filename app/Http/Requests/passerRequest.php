<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class passerRequest extends FormRequest
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
            'id_examen'=>'required | integer | exists:examens,id_examen',
            'codeApogee'=>'required | integer | exists:etudiants,codeApogee',
            'id_local'=>'required | integer | exists:locals,id_local',
            'num_exam'=>'required | integer',
            'isPresent'=>'boolean',
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
            'id_examen.required'=>" l'id_examen doit etre fourni",
            'id_examen.exists:examens,id_examen' =>"le id examen doit etre existe",
            'id_examen.integer' =>"le id examen doit être un  nombre entier",
            'codeApogee.required'=>'le codeApogee doit etre fourni',
            'codeApogee.integer'=>'le codeApogee doit etre entier',
            'codeApogee.exists:etudiants,codeApogee'=>'le codeApogee doit etre existe',
            'id_local.required'=>'le code de local doit etre fourni',
            'id_local.integer'=>'le code du local doit etre entier',
            'id_local.exists:locals,id_local'=>'le code du local doit etre existe',
            'num_exam.required'=>"le num_exam doit être fourni",
            'num_exam.string'=>"num_exam doit être un string",
            'isPresent.boolean'=>"isPresent doi etre un boolean"
                   
        ];
    }
}
