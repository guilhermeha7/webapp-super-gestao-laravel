<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Usando After
     */
    public function up(): void
    {
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->string('site', 200)->after('nome')->nullable(); //after cria a coluna após outra coluna especificada entre parênteses
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->dropColumn('site');
        });
    }
};
