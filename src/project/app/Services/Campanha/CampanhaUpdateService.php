<?php

namespace App\Services\Campanha;

use App\Models\Campanha as Model;


class CampanhaUpdateService
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function update(Object $request,int $id){
        $campanha = $this->model->findOrFail($id);
        $campanha->update([
            'nome'=>$request->nome
        ]);
        return $campanha;
    }
}