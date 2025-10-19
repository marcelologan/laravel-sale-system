<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'categoria_id',
        'estoque',
        'codigo_barras',
        'imagem',
        'status'
    ];

    protected $casts = [
        'preco' => 'decimal:2',
    ];

    // Relacionamento: Um produto pertence a uma categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Scope para produtos ativos
    public function scopeAtivos($query)
    {
        return $query->where('status', 'ativo');
    }

    // Scope para produtos em estoque
    public function scopeEmEstoque($query)
    {
        return $query->where('estoque', '>', 0);
    }

    // Accessor para formatar preço
    public function getPrecoFormatadoAttribute()
    {
        return 'R\$ ' . number_format($this->preco, 2, ',', '.');
    }

    // Accessor para status do estoque
    public function getStatusEstoqueAttribute()
    {
        if ($this->estoque <= 0) {
            return 'Sem estoque';
        } elseif ($this->estoque <= 5) {
            return 'Estoque baixo';
        }
        return 'Em estoque';
    }

    /**
     * Relacionamento com Itens de Pedidos
     */
    public function pedidoItens()
    {
        return $this->hasMany(PedidoItem::class);
    }
}
