<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'subtotal'
    ];

    protected $casts = [
        'quantidade' => 'integer',
        'preco_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    /**
     * Relacionamento com Pedido
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    /**
     * Relacionamento com Produto
     */
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    /**
     * Accessor para formatar preço unitário
     */
    public function getPrecoUnitarioFormatadoAttribute()
    {
        return 'R\$ ' . number_format($this->preco_unitario, 2, ',', '.');
    }

    /**
     * Accessor para formatar subtotal
     */
    public function getSubtotalFormatadoAttribute()
    {
        return 'R\$ ' . number_format($this->subtotal, 2, ',', '.');
    }

    /**
     * Boot method para calcular subtotal automaticamente
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            $item->subtotal = $item->quantidade * $item->preco_unitario;
        });

        static::saved(function ($item) {
            // Recalcular valor total do pedido
            $item->pedido->calcularValorTotal();
        });

        static::deleted(function ($item) {
            // Recalcular valor total do pedido
            $item->pedido->calcularValorTotal();
        });
    }
}