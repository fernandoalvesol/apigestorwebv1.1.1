<?php

namespace App\Http\Controllers\Caixa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Caixa;

class CaixaController extends Controller
{
    private $repositoy;

    public function __construct(Caixa $caixas){

        $this->repository = $caixas;

    }
    
    public function index(){

        $caixas = $this->repository->all();

    	return view('Caixa.caixa', compact('caixas'));

    }
}
