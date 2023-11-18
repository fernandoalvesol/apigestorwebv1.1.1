<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable=["id","status", "descricao" ];

    public function produtos(){
        return $this->hasMany(Produto::class);
    }

    public function clientes(){
        return $this->hasMany(Cliente::class);
    }

    public function vendedor(){
        return $this->hasMany(Vendedor::class);
    }
}
