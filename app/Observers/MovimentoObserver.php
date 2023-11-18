<?php

namespace App\Observers;

use App\Models\Movimento;
use App\Service\EstoqueService;

class MovimentoObserver
{
    public function created(Movimento $movimento){
        EstoqueService::atualizarEstoque($movimento->produto_id, $movimento->qtde_movimento, $movimento->ent_sai);
    }

}
