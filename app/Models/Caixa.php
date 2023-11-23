<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    use HasFactory;
    protected $fillable = [

        "id", "descricao", "operacao", "escritorio", "pagamento", "data", "preco", "tipo"

    ];
}
