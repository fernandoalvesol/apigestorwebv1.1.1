<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;
    protected $fillable =['id', 'status_id', 'nome', 'cpf', 'rg', 'nascimento','logradouro', 'complemento', 'numero', 'bairro', 'telefone', 'celular', 'email',
                          'uf',  'cep', 'ibge', 'cidade', 'nascimento', 'status_id',
    ];

    public function status(){
        return $this->belongsTo(Status::class);
    }
    public static function filtro($filtro, $paginas=0){
        $retorno = Vendedor::orderby("vendedors.id", "asc");

        if($filtro->nome){
            $retorno->where("nome", "like", '%'.$filtro->nome.'%');
        }

        if($filtro->cpf){
            $retorno->where("cpf", "like", '%'.$filtro->cpf.'%');
        }

        if($filtro->email){
            $retorno->where("email", "like", '%'.$filtro->email.'%');
        }

        if($paginas>0){
            $retorno = $retorno->paginate($paginas);
        }else{
            $retorno = $retorno->get();
        }

        return $retorno;

    }
}
