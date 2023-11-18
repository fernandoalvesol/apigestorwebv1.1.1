<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Models\CentroCusto;
use App\Models\Cliente;
use App\Models\FinContaReceber;
use App\Models\Recebimento;
use App\Models\FormaPagto;
use App\Models\Fornecedor;
use App\Models\User;
use App\Models\Venda;
use App\Service\ConstanteService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class RecebimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $filtro                 = new \stdClass();
        $filtro->forma_pagto_id = $_GET["forma_pagto_id"] ?? null;
        $filtro->data01         = $_GET["data01"] ?? hoje();
        $filtro->data02         = $_GET["data02"]  ?? hoje();

        $dados["lista"]         = Recebimento::filtro($filtro);
        $dados["filtro"]        = $filtro;
        $dados["mes"]           = 13;
        $dados["formas"]        = FormaPagto::get();
        return view("Financeiro.Recebimento.Index", $dados);
    }


    public function confirmarRecebimento($id)
    {
        $dados["recebimento"]    = Recebimento::find($id);
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["fornecedores"]  = Fornecedor::get();
        $dados["recebimentos"]    = array();
        return view("Financeiro.Recebimento.ConfirmarRecebimento", $dados);
    }

    public function detalhe($id)
    {
        $dados["recebimento"]    = Recebimento::find($id);
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["fornecedores"]  = Fornecedor::get();
        $dados["recebimentos"] = array();
        return view("Financeiro.Recebimento.Detalhe", $dados);
    }


    public function create()
    {
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["fornecedores"]  = Fornecedor::get();
        $dados["recebimentos"] = array();
        return view("Financeiro.Recebimento.Create", $dados);
    }


    public function store(Request $request)
    {
        $req = $request->except(["_token","_method"]);

        $conta = new \stdClass();
        $conta->descricao               = $req["descricao"];
        $conta->fornecedor_id           = $req["fornecedor_id"];
        $conta->centro_custo_id         = $req["centro_custo_id"];
        $conta->data_emissao            = $req["data_emissao"];
        $conta->valor                   = $req["valor"];
        $conta->qtde_parcela            = $req["qtdParcelas"];
        $conta->primeiro_vencimento     = $req["primeiro_vencimento"];


        return redirect()->route('recebimento.index')->with('msg_sucesso', "Inserido com sucesso.");
    }

    public function pagar(Request $request)
    {
        $req = $request->except(["_token","_method"]);

        $conta = new \stdClass();
        $conta->usuario_id              = auth()->user()->id;
        $conta->descricao_recebimento     = "Conta a Pagar #" .$req["conta_pagar_id"];
        $conta->forma_pagto_id          = $req["forma_pagto_id"];
        $conta->data_recebimento          = hoje();
        $conta->numero_documento        = $req["numero_documento"];
        $conta->observacao              = $req["observacao"];
        $conta->valor_original          = $req["valor_original"];
        $conta->juros                   = $req["juros"];
        $conta->desconto                = $req["desconto"];
        $conta->multa                   = $req["multa"];
        $conta->valor_pago              = $conta->valor_original + $conta->juros + $conta->multa-$conta->desconto;
        $pag = Recebimento::Create(objToArray($conta));
        if($pag){
            Recebimento::where("id", $req["conta_pagar_id"])->update(["recebimento_id"=>$pag->id, "status_id"=>config("constantes.status.PAGO")]);
        }
        return redirect()->route('recebimento.index')->with('msg_sucesso', "Conta Paga com sucesso.");
    }


    public function show($id)
    {
        $dados["recebimento"]    = Recebimento::find($id);
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["fornecedores"]  = Fornecedor::get();
        $dados["recebimentos"] = array();
        return view("Financeiro.Recebimento.Show", $dados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $h = Recebimento::find($id);
            Recebimento::where("recebimento_id", $id)->update(["recebimento_id" => NULL, "status_id"=>config('constantes.status.ABERTO')]);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "item apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            if($cod==23000){
                $mensagem = "Não é possível excluir este registro devido a Integridade Referencial dos Dados";
            }else{
                $mensagem = $e->getMessage();
            }
            return redirect()->back()->with('msg_erro', "Não é Possível Excluir:  [$mensagem]");
        }
    }
}
