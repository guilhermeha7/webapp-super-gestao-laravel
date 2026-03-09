<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Relacionamento 1 para muitos
     */
    public function up(): void
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 5); //cm, mm, kg...
            $table->timestamps();
        });

        //Adiciona a coluna unidade_id na tabela produtos e indica que ela é um identificador que está na tabela unidades
        Schema::table('produtos', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });

        //Adiciona a coluna unidade_id na tabela produto_detalhes e indica que ela é um identificador que está na tabela unidades
        Schema::table('produto_detalhes', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produto_detalhes', function (Blueprint $table) {
            $table->dropForeign(['unidade_id']);  // Remove a chave estrangeira
            $table->dropColumn('unidade_id');     // Remove a coluna
        });

        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['unidade_id']);  // Remove a chave estrangeira
            $table->dropColumn('unidade_id');     // Remove a coluna
        });

        Schema::dropIfExists('unidades');  // Remove a tabela 'unidades'
    }
};
