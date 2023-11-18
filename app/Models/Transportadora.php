<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportadora extends Model
{
    use HasFactory;
    protected $fillable = [ 'id', 'razao_social', 'nome_fantasia', 'cnpj', 'logradouro', 'complemento', 'numero', 'bairro', 'telefone',
                            'celular', 'email', 'uf', 'cep', 'ibge', 'cidade'
    ];

    public static function filtro($filtro, $paginas=0){
        $retorno = Transportadora::orderby("transportadoras.id", "asc");

        if($filtro->nome){
            $retorno->where("razao_social", "like", '%'.$filtro->nome.'%');
        }

        if($filtro->cpf){
            $retorno->where("cnpj", "like", '%'.$filtro->cpf.'%');
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
