<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Create([
            'name'      =>"fernando",
            'email'     =>"fernando@gmail.com",
            'password'  =>bcrypt("aida"),
            'eh_admin'  =>'S',
            'status_id' =>Config('constantes.status.ATIVO')
        ]);
    }
}
