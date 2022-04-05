<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'valor'
    ];

    protected $appends = [
        'valor_br'
    ];

    public function getValorBrAttribute(){
        return "R$ ".number_format($this->valor, 2, ',', '.');
    }
}
