<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class administrateurRequest extends FormRequest
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
            'mail'=>'required | string | max:40 ',
            'nom'=>'required | string| max:20 ',
            'prenom'=>'required| string | max:20 ',
            'motdepasse'=>'required | max:20 ',
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'error'=>true,
            'message'=> 'Erreur de validation',
            'errorList'=>$validator->errors(),

        ])) ;
}


public function messages()
    {
        return[
            'mail.required '=>'mail non fourni',
            'mail.max:40'=>'votre mail ne doit pas depasser 40 characters',
            'nom.required '=>'le nom doit etre fourni',
            'nom.max:20'=>'votre nom ne doit pas depasser 20 characters',
            'prenom.required '=>'un champs prenom doit etre fourni',
            'prenom.max:20'=>'votre nom ne doit pas depasser 20 characters',
            'id_administrateur.integer'=>'le id de ladmin doit etre entier',
            'nom.string'=>"le nom  doit être un string",
            'prenom.string'=>"le prenom  doit être un string",
            'motdepasse.required '=>'le mot de passe doit etre fourni',
            'motdepasse.max:20'=>'votre mot de passe ne doit pas depasser 20 characters',
        ];
    }

}
