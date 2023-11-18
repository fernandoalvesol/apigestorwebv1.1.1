<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContaPagarRequest;
use App\Models\CentroCusto;
use App\Models\ClassificacaoFinanceira;
use App\Models\Cliente;
use App\Models\ContaCorrente;
use App\Models\ContaPagar;
use App\Models\Pagamento;
use App\Models\FormaPagto;
use App\Models\Fornecedor;
use App\Models\PlanoConta;
use App\Models\User;
use App\Models\Venda;
use App\Service\ConstanteService;
use App\Service\ContaPagarSevice;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;


class ContaPagarController extends Controller
{


    public function index()
    {
        $filtro                 = new \stdClass();
        $filtro->fornecedor_id  = $_GET["fornecedor_id"] ?? null;
        $filtro->status_id      = $_GET["status_id"] ?? [];
        $filtro->venc01         = $_GET["venc01"] ?? null;
        $filtro->venc02         = $_GET["venc02"] ?? null;
        $filtro->emissao01      = $_GET["emissao01"] ?? null;
        $filtro->emissao02      = $_GET["emissao02"] ?? null;
        $filtro->mostrar_pagto  = $_GET["mostrar_pagto"] ?? null;
        $filtro->conta_id       = $_GET["conta_id"] ?? null;

        $dados["lista"]         = ContaPagar::filtro($filtro, 20);
        $dados["status"]        = ConstanteService::listaStatusFinanceiro();
        $dados["filtro"]        = $filtro;
        $dados["mes"]           = 13;
        $dados["fornecedores"]  = Fornecedor::get();
        return view("Financeiro.ContaPagar.Index", $dados);
    }

    public function pormes()
    {
        $mes            = $_GET["mes"];
        $ano            = $_GET["ano"];
        $dados["lista"] = ContaPagar::whereMonth("data_vencimento", $mes)->whereYear("data_vencimento", $ano)->get();
        $dados["mes"]   = $mes;
        $dados["fornecedores"]  = Fornecedor::get();
        return view("Financeiro.ContaPagar.Index", $dados);
    }

    public function filtro()
    {
        $filtro                 = new \stdClass();
        $filtro->fornecedor_id  = $_GET["fornecedor_id"];
        $filtro->status_id      = $_GET["status_id"];
        $filtro->venc01         = $_GET["venc01"];
        $filtro->venc02         = $_GET["venc02"];
        $filtro->emissao01      = $_GET["emissao01"];
        $filtro->emissao02      = $_GET["emissao02"];

        $dados["lista"]         = ContaPagar::filtro($filtro);
        $dados["filtro"]        = $filtro;
        $dados["mes"]           = 13;
        $dados["fornecedores"]  = Fornecedor::get();
        return view("Financeiro.ContaPagar.Index", $dados);
    }



    public function confirmarPagamento($id)
    {
        $contapagar = ContaPagar::find($id);
        if($contapagar->status_id == config("constantes.status.DELETADO")){
            return redirect()->back()->with('janela_atencao1', "Não é possível confirmar pagamento para uma conta DELETADA.");
        }

        if($contapagar->status_id == config("constantes.status.PAGO")){
            return redirect()->route('contapagar.detalhe', $id)->with('msg_erro', "Essa conta não pode mais ser modificada.");
        }


        $dados["contapagar"]    = $contapagar;
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["fornecedores"]  = Fornecedor::get();

        $dados["contascorrentes"]   = ContaCorrente::get();
        $dados["planocontas"]       = PlanoConta::where("tipo", "A")->get();
        $dados["pagamentos"]    = array();
        return view("Financeiro.ContaPagar.ConfirmarPagamento", $dados);
    }

    public function detalhe($id)
    {
        $dados["contapagar"]    = ContaPagar::find($id);
        $dados["pagamento"]    = Pagamento::where("conta_pagar_id",$id)->first();

        $dados["formaPagto"]    = FormaPagto::all();
        $dados["fornecedores"]  = Fornecedor::get();
        $dados["pagamentos"] = array();
        return view("Financeiro.ContaPagar.Detalhe", $dados);
    }


    public function create()
    {
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["fornecedores"]  = Fornecedor::get();
        $dados["planos"]        = PlanoConta::where("tipo","A")->get();
        $dados["centros"]       = CentroCusto::get();
        $dados["pagamentos"] = array();
        $dados["fornecedorJs"] = true;
        return view("Financeiro.ContaPagar.Create", $dados);
    }


    public function store(ContaPagarRequest $request)
    {
        $req = $request->except(["_token","_method"]);

        $conta = new \stdClass();
        $conta->descricao               = $req["descricao"];
        $conta->fornecedor_id           = $req["fornecedor_id"];
        $conta->data_emissao            = $req["data_emissao"];
        $conta->valor                   = getFloat($req["valor"]);
        $conta->qtde_parcela            = $req["qtdParcelas"];
        $conta->primeiro_vencimento     = $req["primeiro_vencimento"];
        $conta->origem                  = $req["origem"];

        ContaPagarSevice::novoContaPagar($conta);
        return redirect()->route('contapagar.index')->with('msg_sucesso', "Inserido com sucesso.");
    }

    public function pagar(Request $request)
    {
        $req = $request->except(["_token","_method"]);
        //Altera o status do conta_a_pagar para pago


        $conta = new \stdClass();
       // $conta->usuario_id              = auth()->user()->id;
        $conta->descricao_pagamento     = "Conta a Pagar #" .$req["conta_pagar_id"];
        $conta->forma_pagto_id          = $req["forma_pagto_id"];
        $conta->conta_pagar_id          = $req["conta_pagar_id"];
        $conta->data_pagamento          = hoje();
        $conta->numero_documento        = $req["numero_documento"];
        $conta->observacao              = $req["observacao"];
        $conta->valor_original          = ($req["valor_original"]) ? getFloat($req["valor_original"]) : 0;;
        $conta->juros                   = ($req["juros"]) ? getFloat($req["juros"]) : 0;
        $conta->desconto                = ($req["desconto"]) ? getFloat($req["desconto"]) : 0 ;
        $conta->multa                   = ($req["multa"]) ? getFloat($req["multa"]) : 0;
        $conta->tipo_documento          = $req["tipo_documento"];
        $conta->documento_id            = $req["conta_pagar_id"];
       // $conta->classificacao_financeira_id            = $req["classificacao_financeira_id"];
       // $conta->conta_corrente_id       = $req["conta_corrente_id"];
        $conta->valor_pago              = $conta->valor_original + $conta->juros + $conta->multa-$conta->desconto;


        $pag                            = Pagamento::Create(objToArray($conta));


        return redirect()->route('contapagar.index', ["conta_id"=>$conta->conta_pagar_id, "mostrar_pagto"=>"S"])->with('msg_sucesso', "Conta Paga com sucesso.");
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contapagar = ContaPagar::find($id);;
        if($contapagar->status_id == config("constantes.status.PAGO")){
            return redirect()->route('contapagar.detalhe', $id)->with('msg_erro', "Essa conta não pode mais ser modificada.");
        }

        $dados["contapagar"]    = $contapagar;
        $dados["formaPagto"]    = FormaPagto::all();
        $dados["fornecedores"]  = Fornecedor::get();
        $dados["pagamentos"] = array();
        return view("ContaPagar.Create", $dados);
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
        $retorno = new \stdClass();
        try {
            $req             = $request->except(["_token","_method"]);
            $req["valor"]   = ($req["valor"]) ? getFloat($req["valor"]) : NULL;

            ContaPagar::where("id", $id)->update($req);
            $retorno->tem_erro  = false;
            $retorno->erro      = "";
            return redirect()->route('contapagar.index')->with('msg_sucesso', "Alterado com sucesso.");

        } catch (\Exception $e) {
            $retorno->tem_erro = true;
            $retorno->erro = $e->getMessage();
             return redirect()->back()->with('msg_erro', $e->getMessage());

        }
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
            $h = ContaPagar::find($id);
            if($h->status_id !=config("constantes.status.PAGO")){
                $h->delete();
            }

            return json_encode(1);
            //return redirect()->back()->with('msg_sucesso', "item apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return json_encode(1);
            //return redirect()->back()->with('msg_erro', "Houve um problema ao apagar [$cod]");
        }
    }
}
