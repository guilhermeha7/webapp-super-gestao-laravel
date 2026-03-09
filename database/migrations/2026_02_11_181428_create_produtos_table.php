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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->text('descricao')->nullable(); //->A propriedade nullable vai marcar no banco de dados essa coluna como Nullable, ou seja, como uma coluna que aceita valores nulos
            $table->integer('estoque')->default(1); // A propriedade default(1) define que, caso nenhum valor seja atribuído à coluna 'estoque' do produto, será atribuido o valor 1 a ela.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
