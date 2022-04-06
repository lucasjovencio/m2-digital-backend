<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desconto extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $table = 'descontos';

    protected $fillable = [
        'nome',
        'tipo',
        'valor',
        'ativo',
    ];

    protected $appends = [
        'valor_br',
        'tipo_txt',
        'ativo_txt'
    ];

    public function getValorBrAttribute(){
        if($this->tipo==1){
            return "R$ ".number_format($this->valor, 2, ',', '.');
        }elseif($this->tipo==0){
            return "% ".number_format($this->valor, 2, ',', '.');
        }
        return 0;
    }

    public function getTipoTxtAttribute(){
        switch ($this->tipo) {
            case 0:
                return 'Desconto em porcentagem';
            case 1:
                return 'Desconto em dinheiro';
            default:
                return 'Desconto em dinheiro';
        }
    }

    public function getAtivoTxtAttribute(){
        switch ($this->ativo) {
            case 0:
                return 'Inativo';
            case 1:
                return 'Ativo';
            default:
                return 'Ativo';
        }
    }

    public function scopeWhereAtivo($query){
        return $query->where('ativo',1);
    }
}
