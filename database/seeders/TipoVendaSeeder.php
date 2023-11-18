<?php

namespace Database\Seeders;

use App\Models\TipoVenda;
use Illuminate\Database\Seeder;

class TipoVendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config("constantes.tipo_venda") as $chave=>$valor){
            TipoVenda::Create([
                "tipo_venda"     =>$chave            ]
            );
        }
    }
}
