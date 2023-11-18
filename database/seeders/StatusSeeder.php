<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config("constantes.status") as $chave=>$valor){
            Status::Create([
                "status"    =>$chave,
                "descricao" => $chave
            ]
            );
        }
    }
}
