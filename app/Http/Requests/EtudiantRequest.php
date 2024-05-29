<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EtudiantRequest extends FormRequest
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
            'nom_etudiant'=>'required | string ',
            'prenom_etudiant'=>'required | string',
            'CNE'=>'required | string',
            'photo'=>'required | string',
            'codeApogee'=>'required| integer',
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
            'codeApogee.required'=>"le code apogee de l'etudiant doit etre fourni",
            'codeApogee.unique' =>"le code apogee de l'etudiant doit être unique",
            'codeApogee.integer' =>"le code apogee doit être un  nombre entier",
            'nom_etudiant.required'=>"le nom d'etudiant doit être fourni",
            'nom_etudiant.string'=>"la nom d'etudiant doit être un string",
            'prenom_etudiant.required'=>"le prenom d'etudiant doit être fourni",
            'prenom_etudiant.string'=>"la prenom d'etudiant doit être un string",
            'CNE.required'=>"le CNE d'etudiant doit être fourni",
            'CNE.string'=>"la CNE d'etudiant doit être un string",
            'photo.required'=>"la photo d'etudiant doit être fourni",
            'photo.string'=>"la photo d'etudiant doit être un string",
            

            
        ];
    }
}
