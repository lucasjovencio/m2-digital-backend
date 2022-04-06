<?php

namespace App\Http\Requests\Grupo;

use App\Traits\FailedValidationRequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGrupoRequest extends FormRequest
{
    use FailedValidationRequestTrait;
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|min:3|max:200',
            'campanhas_id'=>[
                'nullable',
                Rule::Exists('campanhas','id')->where(function($query){
                    return $query->whereNull('deleted_at');
                })
            ]
        ];
    }
}
