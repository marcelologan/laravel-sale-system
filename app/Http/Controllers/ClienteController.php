<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cliente::query();

        // Busca por nome, email ou CPF
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('cpf', 'like', "%{$search}%");
            });
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Ordenação
        $sortBy = $request->get('sort_by', 'nome');
        $sortDirection = $request->get('sort_direction', 'asc');

        $allowedSorts = ['nome', 'email', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDirection);
        }

        // Paginação
        $clientes = $query->paginate(10)->withQueryString();

        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'cpf' => 'required|string|size:14|unique:clientes,cpf',
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
            'endereco' => 'nullable|string|max:500',
            'status' => 'required|in:ativo,inativo'
        ]);

        // Criar o cliente
        Cliente::create($validatedData);

        // Redirecionar com mensagem de sucesso
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'cpf' => 'required|string|size:14|unique:clientes,cpf,' . $cliente->id,
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
            'endereco' => 'nullable|string|max:500',
            'status' => 'required|in:ativo,inativo'
        ]);

        // Atualizar o cliente
        $cliente->update($validatedData);

        // Redirecionar com mensagem de sucesso
        return redirect()->route('clientes.show', $cliente)
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            // Salvar o nome para a mensagem
            $nomeCliente = $cliente->nome;

            // Excluir o cliente
            $cliente->delete();

            // Redirecionar para a listagem com mensagem de sucesso
            return redirect()->route('clientes.index')
                ->with('success', "Cliente '{$nomeCliente}' foi excluído com sucesso!");
        } catch (\Exception $e) {
            // Em caso de erro, redirecionar com mensagem de erro
            return redirect()->route('clientes.show', $cliente)
                ->with('error', 'Erro ao excluir o cliente. Tente novamente.');
        }
    }
}
