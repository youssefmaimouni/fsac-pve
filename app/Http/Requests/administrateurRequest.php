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
            'mail'=>'required | string | max:40 | email | unique:administrateurs,mail',
            'nom'=>'required | string| max:20 ',
            'prenom'=>'required| string | max:20 ',
            'mot_de_passe'=>'required | max:30 | min:8 ',
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
            'mail.max'=>'votre mail ne doit pas depasser 40 characters',
            'mail.string'=>"le mail  doit être un string",
            'mail.email'=>'format est incorrecte',
            'mail.unique'=>'ce mail existe deja',
            'nom.required '=>'le nom doit etre fourni',
            'nom.max'=>'votre nom ne doit pas depasser 20 characters',
            'nom.string'=>"le nom  doit être un string",
            'prenom.required '=>'un champs prenom doit etre fourni',
            'prenom.max'=>'votre nom ne doit pas depasser 20 characters',
            'prenom.string'=>"le prenom  doit être un string",
            'nom.string'=>"le nom  doit être un string",
            'mot_de_passe.required '=>'le mot de passe doit etre fourni',
            'mot_de_passe.max'=>'votre mot de passe ne doit pas depasser 30 characters',
            'mot_de_passe.min'=>'votre mot de passe doit étre au moin 8 characters'

        ];
    }

}
