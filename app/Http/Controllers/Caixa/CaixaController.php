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

    public function edit($id){

       $caixas = $this->repository->where('id', $id)->first();

       if(!$caixas)
       return redirect()->back();        

            if($caixas->tipo == "1" )
                    
            return view('Caixa.editentrada', compact('caixas'));

            if($caixas->tipo == "2")

                return view('Caixa.editsaida', compact('caixas'));
             

    }

    public function update(Request $request, $id){

        $caixas = $this->repository->where('id', $id)->first();

        if(!$caixas)
            return redirect()->back();
        
        $caixas->update($request->all());
                
            return redirect()->route('caixa.index');
    }

    public function destroy($id){

        $caixas = $this->repository->find($id);

        if(!$caixas){
            return redirect()->back();
        }

        $caixas->delete();

        return redirect()
                ->route('caixa.index')
                ->with('message', 'Registro deletado com sucesso...');    



    }
}
