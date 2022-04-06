<?php

namespace App\Services\CampanhaProduto;

use App\Models\CampanhaProduto as Model;


class CampanhaProdutoStoreService
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function generate(Object $request){
        return $this->model->firstOrCreate([
            'campanhas_id'=>$request->campanhas_id,
            'produtos_id'=>$request->produtos_id,
        ],['descontos_id'=>$request->descontos_id ?? null]);
    }
}