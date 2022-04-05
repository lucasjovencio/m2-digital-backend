<?php

namespace App\Http\Requests\Desconto;

use App\Traits\FailedValidationRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDescontoRequest extends FormRequest
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
            'nome'  => 'required|min:3|max:200',
            'valor' => 'required',
            'tipo'  => 'required|integer|between:0,1',
            'valor' => 'required|min:3',
            'ativo' => 'required|integer|between:0,1',
        ];
    }
}
