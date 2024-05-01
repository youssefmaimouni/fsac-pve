<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class SurveillantRequest extends FormRequest
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
            'id_surveillant'=>'required | unique|integer',
            'id_departement'=>'required | integer | exists:departements,id_departement',
            'nomComplet_s'=>'required | string ',
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
            'id_surveillant.required'=>"l id du surveillant du surveillant doit etre fourni",
            'id_surveillant.unique' =>"l id du surveillant du surveillant doit être unique",
            'id_surveillant.integer' =>"l id du surveillant doit être un  nombre entier",
            'id_departement.required'=>'le id de departement doit etre fourni',
            'id_departement.integer'=>'le id du departement doit etre entier',
            'id_departement.exists:departements,id_departement'=>'le id du departement doit exister',
            'nomComplet_s.required'=>"le nom du surveillant doit être fourni",
            'nomComplet_s.string'=>"la nom du surveillant doit être un string",
        ];
    }
}
