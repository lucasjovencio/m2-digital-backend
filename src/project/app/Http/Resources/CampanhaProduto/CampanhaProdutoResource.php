<?php

namespace App\Http\Resources\CampanhaProduto;

use App\Http\Resources\CampanhaProduto\Campanha\CampanhaResource;
use App\Http\Resources\Desconto\DescontoResource;
use App\Http\Resources\Produto\ProdutoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CampanhaProdutoResource extends JsonResource
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
            'id'    =>  $this->id,
            'valor'=>$this->valor,
            'valor_br'=>$this->valor_br,
            'campanha'=> new CampanhaResource($this->campanha),
            'produto'=> new ProdutoResource($this->produto),
            'desconto'=> new DescontoResource($this->desconto),
        ];
    }
}
