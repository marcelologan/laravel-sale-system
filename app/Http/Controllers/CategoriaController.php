<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Categoria::withCount('produtos');

        // Busca por nome
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nome', 'like', "%{$search}%");
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Ordenação
        $sortBy = $request->get('sort_by', 'nome');
        $sortDirection = $request->get('sort_direction', 'asc');
        
        $allowedSorts = ['nome', 'produtos_count', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDirection);
        }

        // Paginação
        $categorias = $query->paginate(10)->withQueryString();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome',
            'descricao' => 'nullable|string|max:1000',
            'status' => 'required|in:ativo,inativo'
        ]);

        Categoria::create($validatedData);

        return redirect()->route('categorias.index')
                       ->with('success', 'Categoria cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        $categoria->loadCount('produtos');
        $produtos = $categoria->produtos()->latest()->take(10)->get();
        
        return view('categorias.show', compact('categoria', 'produtos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome,' . $categoria->id,
            'descricao' => 'nullable|string|max:1000',
            'status' => 'required|in:ativo,inativo'
        ]);

        $categoria->update($validatedData);

        return redirect()->route('categorias.show', $categoria)
                       ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        try {
            // Verificar se há produtos vinculados
            if ($categoria->produtos()->count() > 0) {
                return redirect()->route('categorias.show', $categoria)
                               ->with('error', 'Não é possível excluir esta categoria pois existem produtos vinculados a ela.');
            }
            
            $nomeCategoria = $categoria->nome;
            $categoria->delete();
            
            return redirect()->route('categorias.index')
                           ->with('success', "Categoria '{$nomeCategoria}' foi excluída com sucesso!");
                           
        } catch (\Exception $e) {
            return redirect()->route('categorias.show', $categoria)
                           ->with('error', 'Erro ao excluir a categoria. Tente novamente.');
        }
    }
}