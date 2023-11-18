<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;
    protected $fillable =[
        "empresa_id",
        "usuario_id",
        "descricao_pagamento",
        "tipo_documento",
        "conta_pagar_id",
        "despesa_id",
        "fatura_id",
        "forma_pagto_id",
        "classificacao_financeira_id",
        "conta_corrente_id",
        "data_pagamento",
        "numero_documento",
        "observacao",
        "valor_original",
        "valor_pago",
        "juros",
        "desconto",
        "multa",
        "pago"
    ];


    public function forma_pagto(){
        return $this->belongsTo(FormaPagto::class,"forma_pagto_id","id");
    }

    public function conta_pagar(){
        return $this->belongsTo(ContaPagar::class, 'conta_pagar_id');
    }

    public static function filtroPorMes($mes, $ano){
        $retorno = self::whereYear('data_pagamento', '=', $ano)
        ->whereMonth('data_pagamento', '=', $mes)
        ->get();;
        return $retorno;
    }



    public static function filtro($filtro){
        $retorno = Pagamento::orderBy('pagamentos.data_pagamento', 'asc');

        if($filtro->forma_pagto_id){
            $retorno->where("forma_pagto_id", $filtro->forma_pagto_id);
        }

        if($filtro->data01){
            if($filtro->data02){
                $retorno->where("data_pagamento",">=", $filtro->data01)->where("data_pagamento","<=", $filtro->data02);
            }else{
                $retorno->where("data_pagamento", $filtro->data01);
            }
        }


        return $retorno->get();
    }

}
