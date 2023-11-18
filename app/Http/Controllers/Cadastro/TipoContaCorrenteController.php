<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoContaCorrenteRequest;
use App\Models\TipoContaCorrente;
use Illuminate\Http\Request;

class TipoContaCorrenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["lista"] = TipoContaCorrente::get();
        return View("Cadastro.TipoContaCorrente.Index", $dados);
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
    public function store(TipoContaCorrenteRequest $request)
    {
        $req = $request->except(["_token"]);
        try {
            TipoContaCorrente::Create($req);
            return redirect()->route("tipocontacorrente.index")->with("msg_sucesso", "Registro Inserido com Sucesso");
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
        $dados["tipocontacorrente"] = TipoContaCorrente::find($id);
        $dados["lista"] = TipoContaCorrente::get();
        return View('Cadastro.TipoContaCorrente.Index', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoContaCorrenteRequest $request, $id)
    {
        $req = $request->except(["_token", "_method"]);
        try {
            TipoContaCorrente::find($id)->update($req);
            return redirect()->route("tipocontacorrente.index")->with("msg_sucesso", "Registro Alterado com Sucesso");
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
            $tipocontacorrente = TipoContaCorrente::find($id);
            $tipocontacorrente->delete();
            return redirect()->route("tipocontacorrente.index")->with("msg_sucesso", "Registro Excluído com Sucesso");
        } catch (\Throwable $th) {
            return redirect()->back()->with("msg_erro", "Erro: " . $th->getMessage());
        }
    }
}
