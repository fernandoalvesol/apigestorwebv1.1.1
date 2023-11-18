<?php

namespace App\Observers;

use App\Models\ContaReceber;
use App\Models\FinContaReceber;
use App\Models\FinRecebimento;
use App\Models\Recebimento;
use App\Service\MovimentoContaBancariaService;
use App\Models\Venda;

class RecebimentoObserver
{
    public function created(Recebimento $recebimento)
    {
       // MovimentoContaBancariaService::inserirMovimentoRecebimento($recebimento);

        if($recebimento->conta_receber_id ){
            ContaReceber::atualizar($recebimento->conta_receber_id);
            $conta_receber = $recebimento->conta_receber;

        }

    }


}
