<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Produto::with('categoria');

        // Busca por nome ou código de barras
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                    ->orWhere('codigo_barras', 'like', "%{$search}%");
            });
        }

        // Filtro por categoria
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtro por faixa de preço
        if ($request->filled('preco_min')) {
            $query->where('preco', '>=', $request->preco_min);
        }
        if ($request->filled('preco_max')) {
            $query->where('preco', '<=', $request->preco_max);
        }

        // Filtro por status do estoque
        if ($request->filled('estoque_status')) {
            switch ($request->estoque_status) {
                case 'sem_estoque':
                    $query->where('estoque', '<=', 0);
                    break;
                case 'estoque_baixo':
                    $query->where('estoque', '>', 0)->where('estoque', '<=', 5);
                    break;
                case 'em_estoque':
                    $query->where('estoque', '>', 5);
                    break;
            }
        }

        // Ordenação
        $sortBy = $request->get('sort_by', 'nome');
        $sortDirection = $request->get('sort_direction', 'asc');

        $allowedSorts = ['nome', 'preco', 'estoque', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDirection);
        }

        // Paginação
        $produtos = $query->paginate(12)->withQueryString();

        // Buscar categorias para o filtro
        $categorias = \App\Models\Categoria::ativas()->orderBy('nome')->get();

        return view('produtos.index', compact('produtos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::ativas()->orderBy('nome')->get();
        return view('produtos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'preco' => 'required|numeric|min:0.01',
            'categoria_id' => 'required|exists:categorias,id',
            'estoque' => 'required|integer|min:0',
            'codigo_barras' => 'nullable|string|unique:produtos,codigo_barras',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:ativo,inativo'
        ]);

        // Upload da imagem se fornecida
        if ($request->hasFile('imagem')) {
            $validatedData['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }

        Produto::create($validatedData);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        $produto->load('categoria');
        return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $categorias = Categoria::ativas()->orderBy('nome')->get();
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'preco' => 'required|numeric|min:0.01',
            'categoria_id' => 'required|exists:categorias,id',
            'estoque' => 'required|integer|min:0',
            'codigo_barras' => 'nullable|string|unique:produtos,codigo_barras,' . $produto->id,
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:ativo,inativo'
        ]);

        // Upload da nova imagem se fornecida
        if ($request->hasFile('imagem')) {
            // Deletar imagem antiga se existir
            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }
            $validatedData['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }

        $produto->update($validatedData);

        return redirect()->route('produtos.show', $produto)
            ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        try {
            $nomeProduto = $produto->nome;

            // Deletar imagem se existir
            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }

            $produto->delete();

            return redirect()->route('produtos.index')
                ->with('success', "Produto '{$nomeProduto}' foi excluído com sucesso!");
        } catch (\Exception $e) {
            return redirect()->route('produtos.show', $produto)
                ->with('error', 'Erro ao excluir o produto. Tente novamente.');
        }
    }
}
