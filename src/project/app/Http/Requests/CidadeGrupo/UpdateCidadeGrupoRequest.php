<?php

namespace App\Http\Requests\CidadeGrupo;

use App\Traits\FailedValidationRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCidadeGrupoRequest extends FormRequest
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
            'cidades_id'=>'required|exists:cidades,id',
            'grupos_id'=>'required|exists:grupos,id',
        ];
    }
}
