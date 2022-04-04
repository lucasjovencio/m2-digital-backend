<?php

namespace App\Services\Cidade;

use App\Models\Cidade as Model;


class CidadeStoreService
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function generate(Object $request){
        return $this->model->create([
            'nome'=>$request->nome
        ]);
    }
}