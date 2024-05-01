<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ExamenRequest extends FormRequest
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
            'id_session'=>'required | integer | exists:sessions,id_session',
            'code_module'=>'required | integer | exists:modules,code_module',
            'id_pv'=>'required | integer | exists:pvs,id_pv',
            'date_examen'=>'required | date',
            'demi_journee_examen'=>'required | string',
            'seance_examen' =>'required | string'
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
            'id_session.required'=>" l'id_session doit etre fourni",
            'id_session.exists:sessions,id_session' =>"le id session doit etre existe",
            'id_session.integer' =>"le id session doit être un  nombre entier",
            'id_pv.required'=>'le id de pv doit etre fourni',
            'id_pv.integer'=>'le id du pv doit etre entier',
            'id_pv.exists:pvs,id_pv'=>'le id du pv doit etre existe',
            'code_module.required'=>'le code de module doit etre fourni',
            'code_module.integer'=>'le code du module doit etre entier',
            'code_module.exists:modules,code_module'=>'le code du module doit etre existe',
            'demi_journee_examen.required'=>"le la demi journee doit être fourni",
            'demi_journee_examen.string'=>"la demi journee doit être un string",
            'seance_examen.required'=>"la seance d'examen doit être fourni",
            'seance_examen.string'=>"la seance d'examen doit être un string",
            'date_examen.required'=>"le date_examen d'etudiant doit être fourni",
            'date_examen.date'=>"la date_examen d'etudiant doit être une date ",
                   
        ];
    }
}
