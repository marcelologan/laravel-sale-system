<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'endereco',
        'cpf',
        'data_nascimento',
        'status'
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    /**
     * Relacionamento com Pedidos
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    /**
     * Scope para filtrar apenas clientes ativos
     */
    public function scopeAtivas($query)
    {
        return $query->where('status', 'ativo');
    }
}
