<?php

namespace App\Services\Grupo;

use App\Models\Grupo as Model;


class GrupoStoreService
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function generate(Object $request){
        return $this->model->create([
            'nome'=>$request->nome,
            'campanhas_id'=>$request->campanhas_id ?? null,
        ]);
    }
}