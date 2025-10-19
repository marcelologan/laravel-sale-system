<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'data_pedido',
        'status',
        'valor_total',
        'observacoes'
    ];

    protected $casts = [
        'data_pedido' => 'date',
        'valor_total' => 'decimal:2'
    ];

    /**
     * Relacionamento com Cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relacionamento com Itens do Pedido
     */
    public function itens()
    {
        return $this->hasMany(PedidoItem::class);
    }

    /**
     * Accessor para formatar valor total
     */
    public function getValorTotalFormatadoAttribute()
    {
        return 'R\$ ' . number_format($this->valor_total, 2, ',', '.');
    }

    /**
     * Accessor para formatar data do pedido
     */
    public function getDataPedidoFormatadaAttribute()
    {
        return Carbon::parse($this->data_pedido)->format('d/m/Y');
    }

    /**
     * Accessor para cor do status
     */
    public function getStatusCorAttribute()
    {
        return match($this->status) {
            'pendente' => 'bg-yellow-100 text-yellow-800',
            'confirmado' => 'bg-blue-100 text-blue-800',
            'entregue' => 'bg-green-100 text-green-800',
            'cancelado' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Scope para pedidos pendentes
     */
    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    /**
     * Scope para pedidos confirmados
     */
    public function scopeConfirmados($query)
    {
        return $query->where('status', 'confirmado');
    }

    /**
     * Scope para pedidos entregues
     */
    public function scopeEntregues($query)
    {
        return $query->where('status', 'entregue');
    }

    /**
     * Scope para pedidos cancelados
     */
    public function scopeCancelados($query)
    {
        return $query->where('status', 'cancelado');
    }

    /**
     * Calcular e atualizar valor total do pedido
     */
    public function calcularValorTotal()
    {
        $valorTotal = $this->itens()->sum('subtotal');
        $this->update(['valor_total' => $valorTotal]);
        return $valorTotal;
    }

    /**
     * Verificar se pode ser editado
     */
    public function podeSerEditado()
    {
        return in_array($this->status, ['pendente']);
    }

    /**
     * Verificar se pode ser cancelado
     */
    public function podeSerCancelado()
    {
        return in_array($this->status, ['pendente', 'confirmado']);
    }

    /**
     * Confirmar pedido e atualizar estoque
     */
    public function confirmar()
    {
        if ($this->status !== 'pendente') {
            return false;
        }

        // Verificar se há estoque suficiente
        foreach ($this->itens as $item) {
            if ($item->produto->estoque < $item->quantidade) {
                return false;
            }
        }

        // Atualizar estoque dos produtos
        foreach ($this->itens as $item) {
            $item->produto->decrement('estoque', $item->quantidade);
        }

        // Atualizar status do pedido
        $this->update(['status' => 'confirmado']);
        
        return true;
    }

    /**
     * Cancelar pedido e devolver estoque (se confirmado)
     */
    public function cancelar()
    {
        if (!$this->podeSerCancelado()) {
            return false;
        }

        // Se estava confirmado, devolver estoque
        if ($this->status === 'confirmado') {
            foreach ($this->itens as $item) {
                $item->produto->increment('estoque', $item->quantidade);
            }
        }

        // Atualizar status do pedido
        $this->update(['status' => 'cancelado']);
        
        return true;
    }
}