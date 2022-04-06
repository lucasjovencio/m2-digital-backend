<?php

namespace App\Http\Resources\CidadeGrupo;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CidadeGrupoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
