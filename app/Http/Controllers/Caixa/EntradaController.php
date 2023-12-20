<?php

namespace App\Http\Controllers\Caixa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Caixa;


class EntradaController extends Controller
{
    public function index(){

        $title = "Entradas";

        return view('Caixa.index', compact('title'));
    }

    public function store(Request $request){

        Caixa::create($request->all());

        return redirect('/entrada');


    }
    
}
