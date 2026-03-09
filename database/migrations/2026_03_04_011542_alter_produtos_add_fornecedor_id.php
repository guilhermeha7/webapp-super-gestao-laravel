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
        //Cria a coluna fornecedor_id na tabela produtos (Cada produto terá um único fornecedor e cada fornecedor poderá ter vários produtos: relacionamento um para muitos)
        Schema::table('produtos', function (Blueprint $table) {
            $table->unsignedBigInteger('fornecedor_id')->after('id')->nullable(); //Cria a coluna fornecedor_id
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores'); //Define a coluna fornecedor_id como chave estrangeira
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['fornecedor_id']); // Remove a chave estrangeira
            $table->dropColumn('fornecedor_id'); // Remove a coluna fornecedor_id
        });
    }
};
