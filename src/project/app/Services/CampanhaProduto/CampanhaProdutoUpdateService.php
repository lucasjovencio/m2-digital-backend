<?php

namespace App\Services\CampanhaProduto;

use App\Models\CampanhaProduto as Model;


class CampanhaProdutoUpdateService
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function update(Object $request,int $id){
        $campanhaProduto = $this->model->findOrFail($id);
        $campanhaProduto->update([
            'campanhas_id'=>$request->campanhas_id,
            'produtos_id'=>$request->produtos_id,
            'descontos_id'=>$request->descontos_id ?? null
        ]);
        return $campanhaProduto;
    }
}