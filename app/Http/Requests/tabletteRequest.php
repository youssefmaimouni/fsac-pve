<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator ;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class tabletteRequest extends FormRequest
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
            'device_id'=>' string | max:50 | required'
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
            'device_id.string'=>"ladresse  doit être un string",
            'device_id.max:12'=>"ladresse ne doit pas depasser 12 characteres",
            'device_id.required'=>"ladresse est obligatoire",
            "code_association.required"=>"Le code d'association est obligatoire",
            "statut.required"=>"Le champ statut est obligatoire"
        ];
    }
}
