<?php

namespace App\Http\Controllers\Caixa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaixaController extends Controller
{
    
    public function index(){

        return view('Caixa.caixa');
    }
}
