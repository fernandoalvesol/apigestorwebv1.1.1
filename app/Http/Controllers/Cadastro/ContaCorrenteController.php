<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContaCorrenteRequest;
use App\Models\Banco;
use App\Models\ContaCorrente;
use App\Models\TipoContaCorrente;
use Illuminate\Http\Request;

class ContaCorrenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["bancos"] = Banco::get();
        $dados["tipos"] = TipoContaCorrente::get();
        $dados["lista"] = ContaCorrente::get();

        return View("Cadastro.ContaCorrente.Index", $dados);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContaCorrenteRequest $request)
    {
        $req = $request->except(["_token"]);
        try {
            ContaCorrente::Create($req);
            return redirect()->route("contacorrente.index")->with("msg_sucesso", "Registro Inserido com Sucesso");
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
        $dados["contacorrente"] = ContaCorrente::find($id);
        $dados["bancos"] = Banco::get();
        $dados["tipos"] = TipoContaCorrente::get();
        $dados["lista"] = ContaCorrente::get();

        return View('Cadastro.ContaCorrente.Index', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContaCorrenteRequest $request, $id)
    {
        $req = $request->except(["_token", "_method"]);
        try {
            ContaCorrente::find($id)->update($req);
            return redirect()->route("contacorrente.index")->with("msg_sucesso", "Registro Alterado com Sucesso");
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
            $contacorrente = ContaCorrente::find($id);
            $contacorrente->delete();
            return redirect()->route("contacorrente.index")->with("msg_sucesso", "Registro Excluído com Sucesso");
        } catch (\Throwable $th) {
            return redirect()->back()->with("msg_erro", "Erro: " . $th->getMessage());
        }
    }
}
