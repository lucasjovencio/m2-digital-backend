<?php

namespace App\Http\Resources\Campanha\Produto;

use App\Http\Resources\Campanha\CampanhaResource;
use App\Http\Resources\Desconto\DescontoResource;
use App\Http\Resources\Produto\ProdutoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class HasProdutoResource extends JsonResource
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
            'valor_desconto'=>$this->valor_desconto,
            'valor_desconto_br'=>$this->valor_desconto_br,
            'produto'=> new ProdutoResource($this->produto),
            'desconto'=> new DescontoResource($this->desconto),
        ];
    }
}
