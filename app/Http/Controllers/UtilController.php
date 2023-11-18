<?php

namespace App\Http\Controllers;

use App\Service\UtilService;
use Illuminate\Http\Request;
use stdClass;

class UtilController extends Controller
{
    public function buscarCNPJ($cnpj){
        $retorno =new stdClass;
        try {
            $empresa = UtilService::buscarCNPJ($cnpj);
            $retorno->tem_erro = false;
            $retorno->retorno = $empresa;
            return response()->json($retorno);
        } catch (\Throwable $th) {
            $retorno->tem_erro =true;
            $retorno->erro = $th->getMessage();
            return response()->json($retorno);

        }
    }
}
