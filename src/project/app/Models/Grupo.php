<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $table = 'grupos';

    protected $fillable = [
        'nome',
        'campanhas_id'
    ];

    public function campanha(){
        return $this->belongsTo("App\Models\Campanha",'campanhas_id');
    }
}
