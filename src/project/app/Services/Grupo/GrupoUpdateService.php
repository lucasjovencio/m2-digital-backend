<?php

namespace App\Services\Grupo;

use App\Models\Grupo as Model;


class GrupoUpdateService
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function update(Object $request,int $id){
        $grupo = $this->model->findOrFail($id);
        $grupo->update([
            'nome'=>$request->nome,
            'campanhas_id'=>$request->campanhas_id ?? null
        ]);
        return $grupo;
    }
}