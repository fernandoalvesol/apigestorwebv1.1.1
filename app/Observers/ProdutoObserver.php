<?php

namespace App\Observers;

use App\Models\Produto;
use App\Service\MovimentoService;

class ProdutoObserver
{
    public function created(Produto $produto){
            $mov                    = new \stdClass();
            $mov->tipo_movimento_id = config("constantes.tipo_movimento.ENTRADA_INICIO_ESTOQUE");
            $mov->produto_id        = $produto->id;
            $mov->ent_sai           = 'E';
            $mov->estorno           = 'N';
            $mov->data_movimento    = hoje();
            $mov->qtde_movimento    = $produto->estoque_inicial;
            $mov->valor_movimento   = $produto->preco_venda;
            $mov->subtotal_movimento= $mov->qtde_movimento * $mov->valor_movimento;
            $mov->descricao         = "Entrada por cadastro de produto num: " . $produto->id;
            $mov->saldoestoque         = 0;
            if($produto->estoque_inicial > 0){
                MovimentoService::inserir($mov);
            }
    }
}
