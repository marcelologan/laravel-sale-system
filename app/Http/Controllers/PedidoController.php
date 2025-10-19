<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\PedidoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pedido::with(['cliente', 'itens']);

        // Busca por número do pedido ou nome do cliente
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhereHas('cliente', function ($clienteQuery) use ($search) {
                        $clienteQuery->where('nome', 'like', "%{$search}%");
                    });
            });
        }

        // Filtro por cliente
        if ($request->filled('cliente_id')) {
            $query->where('cliente_id', $request->cliente_id);
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtro por período
        if ($request->filled('data_inicio')) {
            $query->where('data_pedido', '>=', $request->data_inicio);
        }
        if ($request->filled('data_fim')) {
            $query->where('data_pedido', '<=', $request->data_fim);
        }

        // Ordenação
        $sortBy = $request->get('sort_by', 'data_pedido');
        $sortDirection = $request->get('sort_direction', 'desc');

        $allowedSorts = ['id', 'data_pedido', 'valor_total', 'status'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDirection);
        }

        // Paginação
        $pedidos = $query->paginate(15)->withQueryString();

        // Buscar clientes para o filtro
        $clientes = Cliente::ativas()->orderBy('nome')->get();

        return view('pedidos.index', compact('pedidos', 'clientes'));
    }

    public function create()
    {
        $clientes = Cliente::ativas()->orderBy('nome')->get();
        $produtos = Produto::ativos()->orderBy('nome')->get(); // ← Mudança aqui

        return view('pedidos.create', compact('clientes', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'data_pedido' => 'nullable|date',
            'observacoes' => 'nullable|string|max:1000',
            'produtos' => 'required|array|min:1',
            'produtos.*.produto_id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Validar estoque ANTES de criar o pedido
            foreach ($request->produtos as $item) {
                $produto = Produto::findOrFail($item['produto_id']);

                if ($item['quantidade'] > $produto->estoque) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Produto '{$produto->nome}' não possui estoque suficiente. Disponível: {$produto->estoque}, Solicitado: {$item['quantidade']}");
                }
            }

            $pedido = Pedido::create([
                'cliente_id' => $request->cliente_id,
                'data_pedido' => $request->data_pedido ?: now()->format('Y-m-d'),
                'status' => 'pendente',
                'valor_total' => 0,
                'observacoes' => $request->observacoes,
            ]);

            $valorTotal = 0;

            foreach ($request->produtos as $item) {
                $produto = Produto::findOrFail($item['produto_id']);
                $subtotal = $produto->preco * $item['quantidade'];

                PedidoItem::create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $produto->preco,
                    'subtotal' => $subtotal,
                ]);

                $valorTotal += $subtotal;
            }

            $pedido->update(['valor_total' => $valorTotal]);

            DB::commit();

            return redirect()->route('pedidos.index')
                ->with('success', 'Pedido criado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao criar pedido: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        $pedido->load(['cliente', 'itens.produto.categoria']);

        return view('pedidos.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        if (!$pedido->podeSerEditado()) {
            return redirect()->route('pedidos.show', $pedido)
                ->with('error', 'Este pedido não pode ser editado pois já foi confirmado.');
        }

        $pedido->load(['cliente', 'itens.produto']);
        $clientes = Cliente::ativas()->orderBy('nome')->get();
        $produtos = Produto::ativos()->with('categoria')->orderBy('nome')->get();

        // Preparar dados dos itens existentes para o JavaScript
        $itensExistentes = $pedido->itens->map(function ($item) {
            return [
                'id' => $item->produto_id,
                'nome' => $item->produto->nome,
                'preco' => (float) $item->preco_unitario,
                'quantidade' => $item->quantidade,
                'subtotal' => (float) $item->subtotal
            ];
        });

        return view('pedidos.edit', compact('pedido', 'clientes', 'produtos', 'itensExistentes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        // Verificar se pode ser editado
        if (!$pedido->podeSerEditado()) {
            return redirect()->route('pedidos.index')
                ->with('error', 'Este pedido não pode ser editado pois já foi confirmado.');
        }

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'data_pedido' => 'nullable|date',
            'observacoes' => 'nullable|string|max:1000',
            'produtos' => 'required|array|min:1',
            'produtos.*.produto_id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Guardar itens originais para restaurar estoque se necessário
            $itensOriginais = $pedido->itens()->with('produto')->get();

            // Se o pedido estava confirmado, devolver estoque dos produtos originais
            if ($pedido->status === 'confirmado') {
                foreach ($itensOriginais as $item) {
                    $item->produto->increment('estoque', $item->quantidade);
                }
            }

            // Validar estoque ANTES de atualizar (considerando o estoque que foi devolvido)
            foreach ($request->produtos as $item) {
                $produto = Produto::findOrFail($item['produto_id']);

                if ($item['quantidade'] > $produto->estoque) {
                    // Se deu erro, restaurar estoque original se necessário
                    if ($pedido->status === 'confirmado') {
                        foreach ($itensOriginais as $itemOriginal) {
                            $itemOriginal->produto->decrement('estoque', $itemOriginal->quantidade);
                        }
                    }

                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Produto '{$produto->nome}' não possui estoque suficiente. Disponível: {$produto->estoque}, Solicitado: {$item['quantidade']}");
                }
            }

            // Remover itens existentes
            $pedido->itens()->delete();

            $valorTotal = 0;

            // Criar novos itens
            foreach ($request->produtos as $item) {
                $produto = Produto::findOrFail($item['produto_id']);
                $subtotal = $produto->preco * $item['quantidade'];

                PedidoItem::create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $produto->preco,
                    'subtotal' => $subtotal,
                ]);

                $valorTotal += $subtotal;
            }

            // Se o pedido estava confirmado, descontar estoque novamente
            if ($pedido->status === 'confirmado') {
                foreach ($request->produtos as $item) {
                    $produto = Produto::findOrFail($item['produto_id']);
                    $produto->decrement('estoque', $item['quantidade']);
                }
            }

            // Atualizar pedido
            $pedido->update([
                'cliente_id' => $request->cliente_id,
                'data_pedido' => $request->data_pedido ?: $pedido->data_pedido,
                'observacoes' => $request->observacoes,
                'valor_total' => $valorTotal,
            ]);

            DB::commit();

            return redirect()->route('pedidos.show', $pedido)
                ->with('success', 'Pedido atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar pedido: ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        try {
            if ($pedido->status === 'confirmado') {
                return redirect()->route('pedidos.show', $pedido)
                    ->with('error', 'Não é possível excluir um pedido confirmado. Cancele-o primeiro.');
            }

            $numeroPedido = $pedido->id;
            $pedido->delete();

            return redirect()->route('pedidos.index')
                ->with('success', "Pedido #{$numeroPedido} foi excluído com sucesso!");
        } catch (\Exception $e) {
            return redirect()->route('pedidos.show', $pedido)
                ->with('error', 'Erro ao excluir o pedido. Tente novamente.');
        }
    }

    /**
     * Confirmar pedido
     */
    public function confirmar(Pedido $pedido)
    {
        try {
            if ($pedido->confirmar()) {
                return redirect()->route('pedidos.show', $pedido)
                    ->with('success', 'Pedido confirmado com sucesso! Estoque atualizado.');
            } else {
                return redirect()->route('pedidos.show', $pedido)
                    ->with('error', 'Não foi possível confirmar o pedido. Verifique se há estoque suficiente.');
            }
        } catch (\Exception $e) {
            return redirect()->route('pedidos.show', $pedido)
                ->with('error', 'Erro ao confirmar pedido: ' . $e->getMessage());
        }
    }

    /**
     * Cancelar pedido
     */
    public function cancelar(Pedido $pedido)
    {
        try {
            if ($pedido->cancelar()) {
                $mensagem = $pedido->status === 'confirmado'
                    ? 'Pedido cancelado com sucesso! Estoque devolvido.'
                    : 'Pedido cancelado com sucesso!';

                return redirect()->route('pedidos.show', $pedido)
                    ->with('success', $mensagem);
            } else {
                return redirect()->route('pedidos.show', $pedido)
                    ->with('error', 'Não foi possível cancelar este pedido.');
            }
        } catch (\Exception $e) {
            return redirect()->route('pedidos.show', $pedido)
                ->with('error', 'Erro ao cancelar pedido: ' . $e->getMessage());
        }
    }

    /**
     * Marcar como entregue
     */
    public function entregar(Pedido $pedido)
    {
        try {
            if ($pedido->status !== 'confirmado') {
                return redirect()->route('pedidos.show', $pedido)
                    ->with('error', 'Apenas pedidos confirmados podem ser marcados como entregues.');
            }

            $pedido->update(['status' => 'entregue']);

            return redirect()->route('pedidos.show', $pedido)
                ->with('success', 'Pedido marcado como entregue!');
        } catch (\Exception $e) {
            return redirect()->route('pedidos.show', $pedido)
                ->with('error', 'Erro ao marcar pedido como entregue: ' . $e->getMessage());
        }
    }
}
