<?php

namespace App\Services\Produto;

use App\Models\Produto as Model;


class ProdutoUpdateService
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function update(Object $request,int $id){
        $filters        = array("R$","R$ ",".",",");
        $filters_alter  = array('','','',".");
        $valor          = ((float)str_replace($filters, $filters_alter, $request->valor));
        $produto        = $this->model->findOrFail($id);
        $produto->update([
            'nome'=>$request->nome,
            'valor'=>$valor
        ]);
        return $produto;
    }
}