<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\DespesaFixaRequest;
use App\Models\CentroCusto;
use App\Models\ContaCorrente;
use App\Models\DespesaFixa;
use App\Models\FormaPagto;
use App\Models\Fornecedor;
use App\Models\PlanoConta;
use Illuminate\Http\Request;
use stdClass;

class DespesaFixaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["lista"]         = DespesaFixa::get();
        $dados["planos"]        = PlanoConta::where("tipo","A")->get();
        $dados["fornecedores"]  = Fornecedor::get();
        $dados["centros"]       = CentroCusto::get();
        $dados["contas"]        = ContaCorrente::get();
        $dados["formas"]        = FormaPagto::get();
        return View("Financeiro.DespesaFixa.Index", $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(DespesaFixaRequest $request)
    {
        $req = $request->except(["_token"]);
        try {
            $req["valor"] = getFloat($req["valor"]);
            DespesaFixa::Create($req);
            return redirect()->route("despesafixa.index")->with("msg_sucesso", "Registro Inserido com Sucesso");
        } catch (\Throwable $th) {
            return redirect()->back()->with("msg_erro", "Erro: " . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $dados["despesafixa"] = DespesaFixa::find($id);
        $dados["lista"]         = DespesaFixa::get();
        $dados["fornecedores"]  = Fornecedor::get();
        $dados["planos"]        = PlanoConta::where("tipo","A")->get();
        $dados["centros"]       = CentroCusto::get();
        $dados["contas"]        = ContaCorrente::get();
        $dados["formas"]        = FormaPagto::get();
        return View('Financeiro.DespesaFixa.Index', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DespesaFixaRequest $request, $id)
    {
        $req = $request->except(["_token", "_method"]);
        try {
            $req["valor"] = getFloat($req["valor"]);
            DespesaFixa::find($id)->update($req);
            return redirect()->route("despesafixa.index")->with("msg_sucesso", "Registro Alterado com Sucesso");
        } catch (\Throwable $th) {
            return redirect()->back()->with("msg_erro", "Erro: " . $th->getMessage());
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
        try {
            $DespesaFixa = DespesaFixa::find($id);
            $DespesaFixa->delete();
            return redirect()->route("despesafixa.index")->with("msg_sucesso", "Registro Excluído com Sucesso");
        } catch (\Throwable $th) {
            return redirect()->back()->with("msg_erro", "Erro: " . $th->getMessage());
        }
    }
}
