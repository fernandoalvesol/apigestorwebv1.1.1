<?php

namespace App\Http\Controllers\Caixa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Caixa;

class CaixaController extends Controller
{
    
    public function index(){

        return view('Caixa.caixa');
    }
}
