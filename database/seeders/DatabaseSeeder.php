<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //BancoSeeder::class,
            //FormaPagtoSeeder::class,
            //StatusSeeder::class,
            //TipoContaCorrenteSeeder::class,
            //TipoMovimentoSeeder::class,
            //TipoVendaSeeder::class,
            //UnidadeSeeder::class,
            UserSeeder::class,

           /* EstadoSeeder::class,
            CfopSeeder::class,
            CstCofinsSeeder::class,
            CstIcmsSeeder::class,
            CstIpiSeeder::class,
            CstPisSeeder::class,
            IcmsEstadoSeeder::class,

            PermissaoSeeder::class,
            MenuSeeder::class,
            FuncaoSeeder::class,
            */
            
        ]);
    }
}
