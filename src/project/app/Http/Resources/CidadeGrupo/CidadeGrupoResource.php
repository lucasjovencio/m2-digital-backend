<?php

namespace App\Http\Resources\CidadeGrupo;

use App\Http\Resources\Cidade\CidadeResource;
use App\Http\Resources\Grupo\GrupoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CidadeGrupoResource extends JsonResource
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
            'cidade'=> new CidadeResource($this->cidade),
            'grupo'=> new GrupoResource($this->grupo),
        ];
    }
}
