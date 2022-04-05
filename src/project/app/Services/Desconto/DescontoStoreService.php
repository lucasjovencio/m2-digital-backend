<?php

namespace App\Services\Desconto;

use App\Models\Desconto as Model;


class DescontoStoreService
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function generate(Object $request){
        $filters        = array("%","% ","R$","R$ ",".",",");
        $filters_alter  = array('','','','','',".");
        $valor          = ((float)str_replace($filters, $filters_alter, $request->valor));
        return $this->model->create([
            'nome'=>$request->nome,
            'valor'=>$valor,
            'tipo'=>$request->tipo,
            'ativo'=>$request->ativo
        ]);
    }
}