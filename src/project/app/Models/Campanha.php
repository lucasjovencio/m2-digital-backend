<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campanha extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $table = 'campanhas';

    protected $fillable = [
        'nome'
    ];

    public function hasProdutos(){
        return $this->hasMany('App\Models\CampanhaProduto','campanhas_id');
    }
}
