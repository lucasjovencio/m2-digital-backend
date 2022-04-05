<?php

namespace App\Http\Requests\Produto;

use App\Traits\FailedValidationRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutoRequest extends FormRequest
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
            'valor'=> 'required'
        ];
    }
}
