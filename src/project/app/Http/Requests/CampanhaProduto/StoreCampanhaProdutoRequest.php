<?php

namespace App\Http\Requests\CampanhaProduto;

use App\Traits\FailedValidationRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class StoreCampanhaProdutoRequest extends FormRequest
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
            'campanhas_id'=>'exists:campanhas,id',
            'produtos_id'=>'exists:produtos,id',
            'descontos_id'=>'nullable|exists:descontos,id',
        ];
    }
}
