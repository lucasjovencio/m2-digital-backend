<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CidadeGrupo extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $table = 'cidade_grupos';

    protected $fillable = [
        'cidades_id',
        'grupos_id',
    ];

    public function cidade(){
        return $this->belongsTo("App\Models\Cidade",'cidades_id');
    }

    public function grupo(){
        return $this->belongsTo("App\Models\Grupo",'grupos_id');
    }

    public function scopeWhereOutroGrupo($query,$id){
        return $query->where('id','<>',$id);
    }

    public function scopeWhereCidadeId($query,$id){
        return $query->where('cidades_id',$id);
    }
}
