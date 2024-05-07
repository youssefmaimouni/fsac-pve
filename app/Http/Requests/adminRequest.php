<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class adminRequest extends FormRequest
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

            'mot_de_passe.required '=>'le mot de passe doit etre fourni',
            'mot_de_passe.max'=>'votre mot de passe ne doit pas depasser 30 characters',
            'mot_de_passe.min'=>'votre mot de passe doit étre au moin 8 characters'

        ];
    }

}
