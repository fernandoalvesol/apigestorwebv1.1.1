<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanoConta extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "pai_id",
        "codigo",
        "conta",
        "alias",
        "tipo",
        "natureza"

    ];
    public function pai()
    {
        return $this->belongsTo(PlanoConta::class, 'pai_id');
    }

    public function filhos()
    {
        return $this->hasMany(PlanoConta::class, 'pai_id');
    }
}
