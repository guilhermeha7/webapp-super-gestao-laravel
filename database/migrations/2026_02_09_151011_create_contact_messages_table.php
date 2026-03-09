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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 100); // Cria a coluna 'nome' com tamanho máximo de 100 caracteres
            $table->string('telefone', 20);
            $table->string('email', 100);
            $table->integer('motivo');
            $table->text('mensagem'); // Cria a coluna 'mensagem' do tipo texto (tipo que armazena textos longos)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
