<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->date('data_pedido');
            $table->enum('status', ['pendente', 'confirmado', 'entregue', 'cancelado'])->default('pendente');
            $table->decimal('valor_total', 10, 2)->default(0);
            $table->text('observacoes')->nullable();
            $table->timestamps();
            
            $table->index(['cliente_id', 'status']);
            $table->index('data_pedido');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};