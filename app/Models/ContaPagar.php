<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaPagar extends Model
{
    use HasFactory;
    protected $fillable =[
        "empresa_id",
        "despesa_id",
        "total_juros",
        "total_multa",
        "total_desconto",
        "total_liquido",
        "total_recebido",
        "total_restante",
        "descricao",
        "fornecedor_id",
        "compra_id",
        "centro_custo_id",
        "num_parcela",
        "ult_parcela",
        "data_emissao",
        "data_vencimento",
        "observacao",
        "valor",
        "status_id",
        "origem",
        "nfe_id"
    ];


    public function pagamento(){
        return $this->belongsTo(Pagamento::class, 'pagamento_id');
    }

    public function pagamentos(){
        return $this->hasMany(Pagamento::class, 'conta_pagar_id', 'id');
    }

    public function fornecedor(){
        return $this->belongsTo(Fornecedor::class,"fornecedor_id");
    }

    public function status(){
        return $this->belongsTo(Status::class,"status_id");
    }

    public function compra(){
        return $this->belongsTo(Compra::class,"compra_id");
    }


    public function forma_pagto(){
        return $this->belongsTo(FormaPagto::class,"forma_pagto_id","id");
    }

    public static function atualizar($id){
        $conta          = ContaPagar::find($id);
        //$valor_recebido = FinRecebimento::where("conta_receber_id", $id)->sum("valor_recebido");
        $valor_original = Pagamento::where("conta_pagar_id", $id)->sum("valor_original");
        $juros          = Pagamento::where("conta_pagar_id", $id)->sum("juros");
        $multa          = Pagamento::where("conta_pagar_id", $id)->sum("multa");
        $desconto	    = Pagamento::where("conta_pagar_id", $id)->sum("desconto");


        $conta->total_juros     = $juros;
        $conta->total_multa     = $multa;
        $conta->total_desconto  = $desconto;
        $conta->total_recebido  = $valor_original;

        $conta->total_liquido   = $valor_original +  $conta->total_juros + $conta->total_multa - $conta->total_desconto;
        $conta->total_restante  = $conta->valor - $valor_original ;
        if($conta->total_restante<=0){
            $conta->status_id    = config("constantes.status.PAGO");
        }
        $conta->save();
    }

    public static function filtro($filtro, $paginas=0){
        $retorno = ContaPagar::orderBy('conta_pagars.data_vencimento', 'asc');
        if($filtro->conta_id){
            $retorno->where("id", $filtro->conta_id);
        }
        if($filtro->fornecedor_id){
            $retorno->where("fornecedor_id", $filtro->fornecedor_id);
        }

        if($filtro->status_id!=null){
            $retorno->whereIn("status_id",$filtro->status_id );
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
