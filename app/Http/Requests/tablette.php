<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tablette extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_tablette'=>'integer ',
            'adresse_mac'=>' string | max:12 ',
            
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
            'id_tablette.integer'=>'le id de tablette doit etre entier',
            'adresse_mac.string'=>"ladresse  doit être un string",
            'adresse_mac.max:12'=>"ladresse ne doit pas depasser 12 characteres",
        ];
    }
}
