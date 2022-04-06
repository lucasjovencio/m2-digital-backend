<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampanhaProduto extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $table = 'campanha_produtos';

    protected $fillable = [
        'campanhas_id',
        'produtos_id',
        'descontos_id',
    ];

    protected $appends = [
        'valor_desconto',
        'valor_desconto_br',
    ];

    public function campanha(){
        return $this->belongsTo("App\Models\Campanha",'campanhas_id');
    }

    public function produto(){
        return $this->belongsTo("App\Models\Produto",'produtos_id');
    }

    public function desconto(){
        return $this->belongsTo("App\Models\Desconto",'descontos_id')->whereAtivo();
    }

    public function getValorDescontoAttribute(){
        $valor = 0;
        if($this->desconto){
            $valor_desconto = $this->desconto->valor;
            if($this->desconto->tipo==1){
                $valor = $this->produto->valor - $valor_desconto;
            }elseif($this->desconto->tipo==0){
                $porcentagem = ($valor_desconto/100) * $this->produto->valor;
                $valor = $this->produto->valor-$porcentagem;
            }
        }
        return ($valor<0) ? 0 : $valor;
    }

    public function getValorDescontoBrAttribute(){
        if($this->desconto){
            return "R$ ".number_format($this->valor_desconto, 2, ',', '.');
        }
        return '';
    }
}
