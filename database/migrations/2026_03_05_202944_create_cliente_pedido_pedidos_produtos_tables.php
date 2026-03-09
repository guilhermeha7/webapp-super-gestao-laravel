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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->timestamps();
        });

        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
        });

        Schema::create('pedidos_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('produto_id');
            $table->timestamps();

            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Como essas tabelas possuem chaves estrangeiras, antes de remover as tabelas, é necessário remover as chaves estrangeiras para evitar erros de integridade referencial.
        Schema::disableForeignKeyConstraints(); // Desabilita as restrições de chave estrangeira para evitar erros ao remover as tabelas
        Schema::dropIfExists('pedidos_produtos');
        Schema::dropIfExists('pedidos');
        Schema::dropIfExists('clientes');
        Schema::enableForeignKeyConstraints();
    }
};
