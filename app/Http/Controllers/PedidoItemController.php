<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoItemController extends Controller
{
    /**
     * Adicionar item ao pedido via AJAX
     */
    public function store(Request $request, Pedido $pedido)
    {
        if (!$pedido->podeSerEditado()) {
            return response()->json([
                'success' => false,
                'message' => 'Este pedido não pode ser editado.'
            ], 400);
        }

        $validatedData = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        try {
            $produto = Produto::find($validatedData['produto_id']);
            
            // Verificar se o item já existe no pedido
            $itemExistente = $pedido->itens()->where('produto_id', $produto->id)->first();
            
            if ($itemExistente) {
                // Atualizar quantidade do item existente
                $itemExistente->update([
                    'quantidade' => $itemExistente->quantidade + $validatedData['quantidade']
                ]);
                $item = $itemExistente;
            } else {
                // Criar novo item
                $item = $pedido->itens()->create([
                    'produto_id' => $produto->id,
                    'quantidade' => $validatedData['quantidade'],
                    'preco_unitario' => $produto->preco,
                    'subtotal' => $validatedData['quantidade'] * $produto->preco
                ]);
            }

            $pedido->load('itens.produto');
            
            return response()->json([
                'success' => true,
                'message' => 'Item adicionado com sucesso!',
                'item' => $item->load('produto'),
                'valor_total' => $pedido->valor_total_formatado
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao adicionar item: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Atualizar item do pedido via AJAX
     */
    public function update(Request $request, PedidoItem $item)
    {
        if (!$item->pedido->podeSerEditado()) {
            return response()->json([
                'success' => false,
                'message' => 'Este pedido não pode ser editado.'
            ], 400);
        }

        $validatedData = $request->validate([
            'quantidade' => 'required|integer|min:1',
        ]);

        try {
            $item->update([
                'quantidade' => $validatedData['quantidade']
            ]);

            $item->pedido->load('itens.produto');
            
            return response()->json([
                'success' => true,
                'message' => 'Item atualizado com sucesso!',
                'item' => $item->fresh()->load('produto'),
                'valor_total' => $item->pedido->valor_total_formatado
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar item: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remover item do pedido via AJAX
     */
    public function destroy(PedidoItem $item)
    {
        if (!$item->pedido->podeSerEditado()) {
            return response()->json([
                'success' => false,
                'message' => 'Este pedido não pode ser editado.'
            ], 400);
        }

        try {
            $pedido = $item->pedido;
            $item->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Item removido com sucesso!',
                'valor_total' => $pedido->fresh()->valor_total_formatado
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao remover item: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Buscar produtos para adicionar ao pedido via AJAX
     */
    public function buscarProdutos(Request $request)
    {
        $search = $request->get('search', '');
        
        $produtos = Produto::ativas()
            ->with('categoria')
            ->where(function($query) use ($search) {
                $query->where('nome', 'like', "%{$search}%")
                      ->orWhere('codigo_barras', 'like', "%{$search}%");
            })
            ->orderBy('nome')
            ->limit(20)
            ->get();

        return response()->json([
            'produtos' => $produtos->map(function($produto) {
                return [
                    'id' => $produto->id,
                    'nome' => $produto->nome,
                    'categoria' => $produto->categoria->nome,
                    'preco' => $produto->preco,
                    'preco_formatado' => $produto->preco_formatado,
                    'estoque' => $produto->estoque,
                    'codigo_barras' => $produto->codigo_barras,
                    'imagem' => $produto->imagem ? asset('storage/' . $produto->imagem) : null
                ];
            })
        ]);
    }
}