<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $consumidor                     = new \stdClass();
        $consumidor->tipo_cliente       = "F";
        $consumidor->eh_consumidor      = "S";
        $consumidor->cpf_cnpj           = "11111111111";
        $consumidor->nome_razao_social  = "CLIENTE CONSUMIDOR";
        $consumidor->indFinal           = "1";
        $consumidor->logradouro         = "logradouro";
        $consumidor->numero             = "123";
        $consumidor->bairro             = "Bairro";
        $consumidor->uf                 = "UF";
        $consumidor->status_id          = config("constantes.status.ATIVO");
        $cliente                        = Cliente::Create(objToArray($consumidor));


    }
}
