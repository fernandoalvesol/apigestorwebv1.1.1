<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaCorrente extends Model
{
    use HasFactory;
    protected $fillable=["id", "banco_id", "tipo_conta_corrente_id","descricao","agencia","conta","pix"];

    public function banco(){
        return $this->belongsTo(Banco::class);
    }

    public function tipoConta(){
        return $this->belongsTo(TipoContaCorrente::class,"tipo_conta_corrente_id");
    }


}


