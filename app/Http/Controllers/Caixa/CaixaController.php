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

    public function search(Request $request){

        $filter = $request->input('filter');

        $caixas = $this->repository
                        ->orWhere('data', '=', '%'.$filter.'%')
                        ->orWhere('data', 'LIKE', '%'.$filter.'%')
                        ->paginate();
        
         return view('Caixa.caixa', compact('caixas', 'filter'));

    }

    public function pesquisar(Request $request){

       $filtrar = $request->input('filtrar');

        $caixas = $this->repository
                        ->orWhere('pagamento', 'LIKE', '%'.$filtrar.'%')
                        ->orWhere('escritorio', 'LIKE', '%'.$filtrar.'%')
                        ->paginate();
        
         return view('Caixa.caixa', compact('caixas', 'filtrar'));

    }
}
