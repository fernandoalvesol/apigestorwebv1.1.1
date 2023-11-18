<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable=["id", "status_id", "categoria_id", "codigo_barra", "nome","gtin","imagem","origem","unidade","preco_venda","preco_custo",
                        "margem_lucro","estoque_minimo","estoque_maximo","estoque_inicial","estoque_atual","ncm","cest","usa_grade","sku"];

    public function status(){
        return $this->belongsTo(Status::class);
    }
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public static function filtro($filtro, $paginas=0){
        $retorno = Produto::where("status_id", config("constantes.status.ATIVO"));

        if($filtro->nome){
            $retorno->where("nome", "like", '%'.$filtro->nome.'%');
        }

        if($filtro->categoria_id){
            $retorno->where("categoria_id", $filtro->categoria_id);
        }

        if($paginas>0){
            $retorno = $retorno->paginate($paginas);
        }else{
            $retorno = $retorno->get();
        }

        return $retorno;

    }

}

