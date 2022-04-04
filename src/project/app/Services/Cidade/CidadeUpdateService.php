<?php

namespace App\Services\Cidade;

use App\Models\Cidade as Model;


class CidadeUpdateService
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function update(Object $request,int $id){
        $cidade = $this->model->findOrFail($id);
        $cidade->update([
            'nome'=>$request->nome
        ]);
        return $cidade;
    }
}