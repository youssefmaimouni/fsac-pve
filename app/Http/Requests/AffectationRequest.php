<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class AffectationRequest extends FormRequest
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
            'id_affectation'=>'required | unique|integer',
            'id_tablette'=>'required | integer | exists:tablettes,id_tablette',
            'id_local'=>'required | integer | exists:locals,id_local',
            'date_affectation'=>'required | date ',
            'demi_journee_affectation'=>'required | char ',
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
            'id_affectation.required'=>"l\'affectation doit etre fourni",
            'id_affectation.unique' =>"l\'affectation doit être unique",
            'id_local.exists:locals,id_local'=>'le id du local doit exister',
            'id_tablette.exists:tablettes,id_tablette'=>'le id du tablette doit exister',
            'date_affectation.required'=>"la date d\'affectation doit être fourni",
            'demi_journee_affectation.required'=>"la demi journee d\'affectation doit être fourni",
        ];
    }
}
