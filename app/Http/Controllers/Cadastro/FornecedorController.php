<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Http\Requests\FornecedorRequest;
use App\Models\Categoria;
use App\Models\Fornecedor;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;

class FornecedorController extends Controller
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

        $dados["lista"] = Fornecedor::filtro($filtro);
        $dados["filtro"] = $filtro;
        return View("Cadastro.Fornecedor.Index", $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dados["fornecedorJs"] = true;
        return View("Cadastro.Fornecedor.Create", $dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FornecedorRequest $request)
    {

        $req = $request->except(["_token"]);
        try {
            Fornecedor::Create($req);
            return redirect()->route("fornecedor.index")->with("msg_sucesso", "inserido com sucesso");
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

    public function pesquisa(){
        $q          = $_GET["q"];
        $fornecedors   = Fornecedor::where("razao_social","like","%$q%")->limit(20)->get();
        return response()->json($fornecedors);
    }

    public function edit($id)
    {
        $dados["fornecedor"] = Fornecedor::find($id);
        $dados["fornecedorJs"] = true;
        return View("Cadastro.Fornecedor.Edit", $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FornecedorRequest $request, $id)
    {
        $req = $request->except(["_token"]);
        try {
            $fornecedor = Fornecedor::find($id);
            $fornecedor->update($req);
            return redirect()->route("fornecedor.index")->with("msg_sucesso", "inserido com sucesso");
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
            $fornecedor = Fornecedor::find($id);
            $fornecedor->delete();
            return redirect()->route("fornecedor.index")->with("msg_sucesso", "excluido com sucesso");
        } catch (\Throwable $th) {
            return redirect()->back()->with("msg_erro", "Erro: " . $th->getMessage());
        }
    }
}
