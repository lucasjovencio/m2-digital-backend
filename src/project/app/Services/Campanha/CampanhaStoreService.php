<?php

namespace App\Services\Campanha;

use App\Models\Campanha as Model;


class CampanhaStoreService
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