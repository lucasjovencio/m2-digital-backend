<?php

namespace App\Http\Resources\Desconto;

use Illuminate\Http\Resources\Json\JsonResource;

class DescontoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        =>  $this->id,
            'nome'      =>  $this->nome,
            'valor'     =>  $this->valor,
            'valor_br'  =>  $this->valor_br,
            'tipo'      =>  $this->tipo,
            'tipo_txt'  =>  $this->tipo_txt,
            'ativo'     =>  $this->ativo,
            'ativo_txt' =>  $this->ativo_txt,
        ];
    }
}
