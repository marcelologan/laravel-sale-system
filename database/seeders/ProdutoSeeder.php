<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = [
            [
                'nome' => 'Smartphone Samsung Galaxy',
                'descricao' => 'Smartphone com tela de 6.1 polegadas, 128GB de armazenamento',
                'preco' => 1299.99,
                'categoria_id' => 1, // Eletrônicos
                'estoque' => 15,
                'codigo_barras' => '7891234567890',
                'status' => 'ativo'
            ],
            [
                'nome' => 'Notebook Dell Inspiron',
                'descricao' => 'Notebook com processador Intel i5, 8GB RAM, SSD 256GB',
                'preco' => 2499.90,
                'categoria_id' => 1, // Eletrônicos
                'estoque' => 8,
                'codigo_barras' => '7891234567891',
                'status' => 'ativo'
            ],
            [
                'nome' => 'Camiseta Polo',
                'descricao' => 'Camiseta polo masculina, 100% algodão',
                'preco' => 89.90,
                'categoria_id' => 2, // Roupas
                'estoque' => 25,
                'codigo_barras' => '7891234567892',
                'status' => 'ativo'
            ],
            [
                'nome' => 'Jeans Feminino',
                'descricao' => 'Calça jeans feminina skinny, diversos tamanhos',
                'preco' => 129.90,
                'categoria_id' => 2, // Roupas
                'estoque' => 12,
                'codigo_barras' => '7891234567893',
                'status' => 'ativo'
            ],
            [
                'nome' => 'Sofá 3 Lugares',
                'descricao' => 'Sofá confortável para sala de estar',
                'preco' => 899.90,
                'categoria_id' => 3, // Casa e Jardim
                'estoque' => 3,
                'codigo_barras' => '7891234567894',
                'status' => 'ativo'
            ],
            [
                'nome' => 'Livro: Laravel na Prática',
                'descricao' => 'Guia completo para desenvolvimento com Laravel',
                'preco' => 79.90,
                'categoria_id' => 4, // Livros
                'estoque' => 20,
                'codigo_barras' => '7891234567895',
                'status' => 'ativo'
            ],
            [
                'nome' => 'Bola de Futebol',
                'descricao' => 'Bola oficial de futebol, tamanho padrão',
                'preco' => 45.90,
                'categoria_id' => 5, // Esportes
                'estoque' => 30,
                'codigo_barras' => '7891234567896',
                'status' => 'ativo'
            ],
            [
                'nome' => 'Tênis de Corrida',
                'descricao' => 'Tênis esportivo para corrida e caminhada',
                'preco' => 199.90,
                'categoria_id' => 5, // Esportes
                'estoque' => 2, // Estoque baixo para teste
                'codigo_barras' => '7891234567897',
                'status' => 'ativo'
            ]
        ];

        foreach ($produtos as $produto) {
            Produto::create($produto);
        }
    }
}