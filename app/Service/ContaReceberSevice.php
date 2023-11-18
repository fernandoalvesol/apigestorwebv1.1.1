<?php
namespace App\Service;

use App\Models\FinContaReceber;
use App\Models\Duplicata;
use App\Models\NfeDuplicata;
use App\Models\Cliente;
use App\Models\ContaReceber;

class ContaReceberSevice{
    public static function novoContaReceber($conta){
        for ($i=0; $i< $conta->qtde_parcela; $i++) {
                $con = new \stdClass();
                $con->cliente_id	 = $conta->cliente_id;
                $con->num_parcela	 = $i+1;
                $con->ult_parcela	 = $conta->qtde_parcela;
                $con->data_emissao	 = $conta->data_emissao;
                $con->data_vencimento= somarData($conta->primeiro_vencimento, $i * 30);
                $con->data_previsao	 = $con->data_vencimento ;
                $con->descricao	     = $conta->descricao ;
                $con->valor	         = $conta->valor  ;
                $con->origem	     = $conta->origem;

                ContaReceber::Create(objToArray($con));
        }

    }




}

