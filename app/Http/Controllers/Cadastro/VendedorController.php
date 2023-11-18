<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendedorRequest;
use App\Models\Categoria;
use App\Models\Vendedor;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtro = new stdClass;
        $filtro->nome          = $request->nome ?? null;
        $filtro->cpf           = $request->cpf ?? null;
        $filtro->email          = $request->email ?? null;

        $dados["lista"] = Vendedor::filtro($filtro);
        $dados["filtro"] = $filtro;
        return View("Cadastro.Vendedor.Index", $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dados["vendedorJs"] = true;
        return View("Cadastro.Vendedor.Create", $dados);
    }

    public function pesquisa(){
        $q          = $_GET["q"];
        $vendedors   = Vendedor::where("nome","like","%$q%")->get();

        return response()->json($vendedors);
    }

    public function store(VendedorRequest $request)
    {

        $req = $request->except(["_token"]);
        try {
            $req["status_id"] = config("constantes.status.ATIVO");
            Vendedor::Create($req);
            return redirect()->route("vendedor.index")->with("msg_sucesso", "inserido com sucesso");
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
        $dados["vendedor"] = Vendedor::find($id);
        $dados["vendedorJs"] = true;
        return View("Cadastro.Vendedor.Edit", $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendedorRequest $request, $id)
    {
        $req = $request->except(["_token"]);
        try {

            $vendedor = Vendedor::find($id);
            $vendedor->update($req);
            return redirect()->route("vendedor.index")->with("msg_sucesso", "inserido com sucesso");
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
            $vendedor = Vendedor::find($id);
            $vendedor->delete();
            return redirect()->route("vendedor.index")->with("msg_sucesso", "excluido com sucesso");
        } catch (\Throwable $th) {
            return redirect()->back()->with("msg_erro", "Erro: " . $th->getMessage());
        }
    }
}
