<?php

namespace App\Observers;

use App\Models\ContaPagar;
use App\Models\FinContaPagar;
use App\Models\FinPagamento;
use App\Models\Pagamento;
use App\Service\MovimentoContaBancariaService;

class PagamentoObserver
{
    public function created(Pagamento $pagamento)
    {

        //MovimentoContaBancariaService::inserirMovimentoPagamento($pagamento);

        if($pagamento->conta_pagar_id ){
            ContaPagar::atualizar($pagamento->conta_pagar_id);
        }

    }


}
