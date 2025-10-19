<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            [
                'nome' => 'Eletrônicos',
                'descricao' => 'Produtos eletrônicos em geral',
                'status' => 'ativo'
            ],
            [
                'nome' => 'Roupas',
                'descricao' => 'Vestuário masculino e feminino',
                'status' => 'ativo'
            ],
            [
                'nome' => 'Casa e Jardim',
                'descricao' => 'Produtos para casa e decoração',
                'status' => 'ativo'
            ],
            [
                'nome' => 'Livros',
                'descricao' => 'Livros e materiais educativos',
                'status' => 'ativo'
            ],
            [
                'nome' => 'Esportes',
                'descricao' => 'Equipamentos e acessórios esportivos',
                'status' => 'ativo'
            ]
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}