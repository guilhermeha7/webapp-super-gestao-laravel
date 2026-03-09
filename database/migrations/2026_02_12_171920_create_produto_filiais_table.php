<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
     Relacionamento muitos para muitos.
     */

    public function up(): void
    {
        //Criando a tabela filiais
        Schema::create('filiais', function (Blueprint $table) {
            $table->id();
            $table->string('filial', 50);
            $table->timestamps();
        });

        //Criando a tabela produto_filiais
        Schema::create('produto_filiais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('filial_id');
            $table->unsignedBigInteger('produto_id');
            $table->integer('estoque');
            $table->timestamps();

            $table->foreign('filial_id')->references('id')->on('filiais');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });

        //Removendo as colunas da tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('estoque');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remover as restrições de chave estrangeira
        Schema::table('produto_filiais', function (Blueprint $table) {
            $table->dropForeign(['filial_id']);
            $table->dropForeign(['produto_id']);
        });

        // Remover a tabela produto_filiais
        Schema::dropIfExists('produto_filiais');

        // Remover a tabela filiais
        Schema::dropIfExists('filiais');

        // Adicionar a coluna estoque de volta na tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->integer('estoque')->nullable(); // ou defina um valor padrão se necessário
        });
    }
};
