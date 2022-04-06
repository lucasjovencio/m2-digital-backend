<?php

namespace App\Services\CidadeGrupo;

use App\Models\CidadeGrupo as Model;
use Illuminate\Validation\ValidationException;

class CidadeGrupoUpdateService
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function update(Object $request,int $id){
        $cidadeGrupo = $this->model->findOrFail($id);
        if($cidadeGrupo->cidades_id != $request->cidades_id && $this->model->whereOutroGrupo($id)->whereCidadeId($request->cidades_id)->first()){
            throw ValidationException::withMessages([
                'cidades_id' => "O campo cidades id já está sendo utilizado."
            ]);
        }
        $cidadeGrupo->update([
            'cidades_id'=>$request->cidades_id,
            'grupos_id'=>$request->grupos_id,
        ]);
        return $cidadeGrupo;
    }
}