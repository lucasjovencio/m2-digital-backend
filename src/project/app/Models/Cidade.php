<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $table = 'cidades';

    protected $fillable = [
        'nome'
    ];
}
