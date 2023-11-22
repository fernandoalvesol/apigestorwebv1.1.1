<?php

namespace App\Http\Controllers\Caixa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Caixa;


class SaidaController extends Controller
{
    public function index(){

        $title = "Saidas do Caixa";

        return view('Caixa.saidas', compact('title'));
    }

    public function store(Request $request, Caixa $caixa){

        $data = $request->all();
        $data['tipo'] = '2';

        Caixa::create($data);

        return redirect('/saida');


    }
}
