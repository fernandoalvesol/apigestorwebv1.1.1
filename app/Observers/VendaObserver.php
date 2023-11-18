<?php

namespace App\Observers;

use App\Models\Venda;
use Illuminate\Support\Facades\Auth;


class VendaObserver
{
    public function creating(Venda $venda){
        $venda->valor_total_venda       = 0;
        $venda->valor_bruto             = 0;
        $venda->valor_frete             = 0;
        $venda->valor_imposto           = 0;
        $venda->desconto_por_valor      = 0;
        $venda->desconto_por_percentual = 0;
        $venda->valor_total_do_desconto = 0;
        $venda->valor_desconto_cupom    = 0;
        $venda->total_desconto_item     = 0;
        $venda->acrescimo_por_valor     = 0;
        $venda->acrescimo_por_percentual= 0;
        $venda->valor_total_do_acrescimo= 0;
        $venda->valor_total_liquido     = 0;
        $venda->data_venda              = hoje();
        $venda->status_id               = config("constantes.status.DIGITACAO");
        $venda->status_financeiro_id    = config("constantes.status.ABERTO");

      //  $venda->usuario_id          = Auth::user()->getAuthIdentifier();

    }


    public function updating(Venda $venda){

    }
    public function created(Venda $venda){
       /* if($venda->pedido_cliente_id){
            $pedido                   = PedidoCliente::where("id", $venda['pedido_id'])->first();
            $pedido->venda_id         = $venda->id;
            $pedido->data_atendimento = hoje();
            $pedido->status_id        = config("constantes.status.FINALIZADO");
            $pedido->save();
        }*/

    }


}


