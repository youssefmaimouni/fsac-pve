<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditModuleRequest extends FormRequest
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
            'intitule_module'=>'required | unique_module_in_filiere:'.$this->input('id_filiere'),
            'id_filiere'=>'required | integer | exists:filieres,id_filiere'
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
            'intitule_module.required'=>'une intitule de module doit etre fourni',
            'intitule_module.unique_module_in_filiere' => 'Le nom du module doit être unique dans la filière spécifiée.',
            'id_filiere.required'=>'le id de filiére doit etre fourni',
            'id_filiere.integer'=>'le id de filiére doit etre entier',
            'id_filiere.exists:filieres,id_filiere'=>'le id de filiére doit etre existe'
            
        ];
    }
}
