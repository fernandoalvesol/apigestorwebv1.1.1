<?php

namespace App\Http\Controllers\Cadastro;

use App\Http\Controllers\Controller;
use App\Models\Movimento;
use App\Models\Produto;
use App\Models\TipoMovimento;
use Illuminate\Http\Request;
use stdClass;

class MovimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtro = new stdClass;
        $filtro->data1         = $request->data1 ?? hoje();
        $filtro->data2         = $request->data2 ?? hoje();
        $filtro->produto_id    = $request->produto_id ?? null;
        $filtro->tipo_movimento_id    = $request->tipo_movimento_id ?? null;
        $filtro->ent_sai        = $request->ent_sai ?? null;
        $filtro->descricao      = $request->descricao ?? null;


        $dados["lista"] = Movimento::filtro($filtro);
        $dados["produtos"] = Produto::get();
        $dados["tipos"] = TipoMovimento::get();
        $dados["filtro"] = $filtro;
        $dados["movimentoJs"] = true;
        return View('Cadastro.Movimento.Index',$dados);
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
    public function salvarJs(Request $request)
    {
        $retorno = new stdClass;
        try {
            $produto = Produto::find($request->produto_id);
            $obj                    = new stdClass;
            $obj->produto_id        = $request->produto_id;
            $obj->qtde_movimento      = getFloat($request->qtde);
            $obj->valor_movimento     = getFloat($produto->preco_venda);
            $obj->subtotal_movimento  = $obj->qtde_movimento * $obj->valor_movimento;
            $obj->data_movimento      = hoje();
            Movimento::Create(objToArray($obj));
            $retorno->tem_erro = false;
            return response()->json($retorno);
        } catch (\Throwable $th) {
            $retorno->tem_erro = true;
            $retorno->erro = $th->getMessage();
            return response()->json($retorno,401);
        }
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dados["produto"] = Produto::find($id);
        $dados["lista"] = Movimento::where("produto_id", $id)->get();
        $dados["soma_entradas"] = Movimento::where(["ent_sai"=> "E","produto_id"=>$id])->sum("subtotal_movimento");
        $dados["soma_saidas"] = Movimento::where(["ent_sai"=> "S","produto_id"=>$id])->sum("subtotal_movimento");
        $dados["qtde_entrada"] = Movimento::where(["ent_sai"=> "E","produto_id"=>$id])->sum("qtde_movimento");
        $dados["qtde_saida"] = Movimento::where(["ent_sai"=> "S","produto_id"=>$id])->sum("qtde_movimento");
        return View("Cadastro.Movimento.Estoque", $dados);
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
        //
    }
}
