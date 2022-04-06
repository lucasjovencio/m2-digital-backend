<?php

namespace App\Http\Requests\CampanhaProduto;

use App\Traits\FailedValidationRequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCampanhaProdutoRequest extends FormRequest
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
            'campanhas_id'=>[
                'required',
                Rule::Exists('campanhas','id')->where(function($query){
                    return $query->whereNull('deleted_at');
                })
            ],
            'produtos_id'=>[
                'required',
                Rule::Exists('produtos','id')->where(function($query){
                    return $query->whereNull('deleted_at');
                })
            ],
            'descontos_id'=>[
                'nullable',
                Rule::Exists('descontos','id')->where(function($query){
                    return $query->whereNull('deleted_at');
                })
            ],
        ];
    }
}
