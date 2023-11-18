<?php

namespace App\Observers;

use App\Models\Entrada;
use App\Service\MovimentoService;

class EntradaObserver
{
    public function created(Entrada $entrada){
            $mov                    = new \stdClass();
            $mov->tipo_movimento_id = config("constantes.tipo_movimento.ENTRADA_AVULSA");
            $mov->produto_id        = $entrada->produto_id;
            $mov->entrada_avulsa_id = $entrada->id;
            $mov->ent_sai           = 'E';
            $mov->estorno           = 'N';
            $mov->data_movimento    = $entrada->data_entrada;
            $mov->qtde_movimento    = $entrada->qtde_entrada;
            $mov->valor_movimento   = $entrada->valor_entrada;
            $mov->subtotal_movimento= $entrada->subtotal_entrada;
            $mov->descricao         = "Entrada Avulsa num: " . $entrada->id;
            $mov->saldoestoque         = 0;
            MovimentoService::inserir($mov);
    }
}
