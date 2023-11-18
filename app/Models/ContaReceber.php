<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    use HasFactory;
    protected $fillable =[
        "empresa_id",
        "usuario_id",
        "descricao",
        "total_juros",
        "total_multa",
        "data_previsao",
        "total_desconto",
        "total_liquido",
        "total_recebido",
        "total_restante",
        "forma_pagto_id",
        "cliente_id",
        "venda_id",
        "pdvduplicata_id",
        "loja_pedido_id",
        "centro_custo_id",
        "forma_pagto_id",
        "num_parcela",
        "ult_parcela",
        "data_emissao",
        "data_vencimento",
        "observacao",
        "valor",
        "status_id",
        "cobranca_id",
        "nfe_id",
        "origem"
    ];


    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function recebimentos(){
        return $this->hasMany(Recebimento::class, 'conta_receber_id', 'id');
    }


    public function forma_pagto(){
        return $this->belongsTo(FormaPagto::class, 'forma_pagto_id');
    }

    public function venda(){
        return $this->belongsTo(Venda::class, 'venda_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public static function atualizar($id){
        $conta          = ContaReceber::find($id);
        //$valor_recebido = FinRecebimento::where("conta_receber_id", $id)->sum("valor_recebido");
        $valor_original = Recebimento::where("conta_receber_id", $id)->sum("valor_original");
        $juros          = Recebimento::where("conta_receber_id", $id)->sum("juros");
        $multa          = Recebimento::where("conta_receber_id", $id)->sum("multa");
        $desconto	    = Recebimento::where("conta_receber_id", $id)->sum("desconto");


        $conta->total_juros     = $juros;
        $conta->total_multa     = $multa;
        $conta->total_desconto  = $desconto;
        $conta->total_recebido  = $valor_original;

        $conta->total_liquido   = $valor_original +  $conta->total_juros + $conta->total_multa - $conta->total_desconto;
        $conta->total_restante  = $conta->valor - $valor_original ;

        if($conta->total_restante>0){
            $conta->status_id    = config("constantes.status.PARCIALMENTE_PAGO");
        }

        if($conta->total_restante<=0){
            $conta->status_id    = config("constantes.status.PAGO");
        }
        $conta->save();
    }

    public static function filtro($filtro, $paginas=0){
        $retorno = ContaReceber::orderBy('conta_recebers.data_vencimento', 'asc');
        if($filtro->conta_id){
            $retorno->where("id", $filtro->conta_id);
        }

        if($filtro->cliente_id){
            $retorno->where("cliente_id", $filtro->cliente_id);
        }


        if($filtro->status_id!=null){
            $retorno->whereIn("status_id",$filtro->status_id );
        }

        if($filtro->venda_id){

            $retorno->where("venda_id", $filtro->venda_id);
        }

        if($filtro->venc01){
            if($filtro->venc02){
                $retorno->where("data_vencimento",">=", $filtro->venc01)->where("data_vencimento","<=", $filtro->venc02);
            }else{
                $retorno->where("data_vencimento", $filtro->venc01);
            }
        }

        if($filtro->emissao01){
            if($filtro->emissao02){
                $retorno->where("data_emissao",">=", $filtro->emissao01)->where("data_emissao","<=", $filtro->emissao02);
            }else{
                $retorno->where("data_emissao", $filtro->emissao01);
            }
        }

        if($paginas > 0){
            $retorno = $retorno->paginate($paginas);
        }else{
            $retorno = $retorno->get();
        }

        return $retorno;

    }
}
