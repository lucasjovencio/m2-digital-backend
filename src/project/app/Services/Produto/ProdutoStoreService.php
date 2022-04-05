<?php

namespace App\Services\Produto;

use App\Models\Produto as Model;


class ProdutoStoreService
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function generate(Object $request){
        $filters        = array("R$","R$ ",".",",");
        $filters_alter  = array('','','',".");
        $valor          = ((float)str_replace($filters, $filters_alter, $request->valor));
        return $this->model->create([
            'nome'=>$request->nome,
            'valor'=>$valor,
        ]);
    }
}