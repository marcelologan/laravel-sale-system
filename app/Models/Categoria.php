<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'status'
    ];

    // Relacionamento: Uma categoria tem muitos produtos
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    // Scope para categorias ativas
    public function scopeAtivas($query)
    {
        return $query->where('status', 'ativo');
    }
}