<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DespesaFixa extends Model
{
    use HasFactory;
    protected $fillable =[
        "plano_conta_id",
        "fornecedor_id",
        "centro_custo_id",
        "conta_corrente_id",
        "forma_pagto_id",
        "descricao",
        "vigencia_inicial",
        "vigencia_final",
        "dia_vencimento",
        "valor",
    ];

    public function planoconta(){
        return $this->belongsTo(PlanoConta::class, 'plano_conta_id');
    }

    public function fornecedor(){
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function centrocusto(){
        return $this->belongsTo(CentroCusto::class, 'centro_custo_id');
    }

    public function contacorrente(){
        return $this->belongsTo(ContaCorrente::class, 'conta_corrente_id');
    }

    public function forma_pagto(){
        return $this->belongsTo(FormaPagto::class, 'forma_pagto_id');
    }
}
