<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Relacionamento 1 para 1
     */
    public function up(): void
    {
        Schema::create('produto_detalhes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id'); //Define que a chave estrangeira produto_id será do mesmo tipo que a chave id da tabela produtos, ou seja, unsignedBigInteger
            $table->float('comprimento', 20, 2);
            $table->float('largura', 20, 2); //Aqui 20 representa o número total de dígitos que a coluna pode armazenar. O segundo número (2) define o número máximo de casas com vírgula que o banco pode armazenar.
            $table->float('altura', 20, 2);
            $table->timestamps();

            //Indica que o identificador produto_id faz referência ao identificador id da tabela produtos
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->unique('produto_id'); //Impede produto_id de ter um valor repetido. Garante um relacionamento 1 para 1, ou seja, que cada produto terá apenas um produto_detalhes, e não vários.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_detalhes');
    }
};
