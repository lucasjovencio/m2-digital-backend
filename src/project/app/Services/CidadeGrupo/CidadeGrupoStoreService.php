<?php

namespace App\Services\CidadeGrupo;

use App\Models\CidadeGrupo as Model;


class CidadeGrupoStoreService
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function generate(Object $request){
        return $this->model->firstOrCreate([
            'cidades_id'=>$request->cidades_id,
            'grupos_id'=>$request->grupos_id,
        ]);
    }
}