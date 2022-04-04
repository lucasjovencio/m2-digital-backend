<?php

namespace App\Http\Requests\Cidade;

use App\Traits\FailedValidationRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class StoreCidadeRequest extends FormRequest
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
            'nome' => 'required|min:5|max:200',
        ];
    }
}