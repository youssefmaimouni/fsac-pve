<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class gPVRequest extends FormRequest
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
            'id_local'=>'required',
            'demi_journee'=>'required | string ',
            'date'=>'required | date',
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
            'id_local.required'=>'Le champ device_id est obligatoire',
            'date.required'=>"la date d\'affectation doit être fourni",
            'demi_journee.required'=>"la demi journee d\'affectation doit être fourni",
            'date.date'=>"la date d\'affectation doit être date",
            'demi_journee.char'=>"la demi journee d\'affectation doit être une chaine de charactere",
        ];
    }
}
