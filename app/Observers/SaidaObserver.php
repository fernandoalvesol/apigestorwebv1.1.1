<?php

namespace App\Observers;

use App\Models\Saida;
use App\Service\MovimentoService;

class SaidaObserver
{
    public function created(Saida $saida){
            $mov                    = new \stdClass();
            $mov->tipo_movimento_id = config("constantes.tipo_movimento.SAIDA_AVULSA");
            $mov->produto_id        = $saida->produto_id;
            $mov->saida_avulsa_id = $saida->id;
            $mov->ent_sai           = 'S';
            $mov->estorno           = 'N';
            $mov->data_movimento    = $saida->data_saida;
            $mov->qtde_movimento    = $saida->qtde_saida;
            $mov->valor_movimento   = $saida->valor_saida;
            $mov->subtotal_movimento= $saida->subtotal_saida;
            $mov->descricao         = "Saida Avulsa num: " . $saida->id;
            $mov->saldoestoque         = 0;

            MovimentoService::inserir($mov);
    }
}
