<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ContactMessage;
use App\Models\MotivoDeContato;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        //✔️ Passo 1: Cria a tabela motivos_de_contato
        Schema::create('motivos_de_contato', function (Blueprint $table) {
            $table->id();
            $table->string('motivo')->unique();
            $table->timestamps();
        });

        //✔️ Passo 2: Popula a tabela motivos_de_contato
        MotivoDeContato::create(['motivo' => 'Dúvida']);
        MotivoDeContato::create(['motivo' => 'Sugestão']);
        MotivoDeContato::create(['motivo' => 'Problema']);
        MotivoDeContato::create(['motivo' => 'Elogio']);

        //✔️ Passo 3: Cria a coluna motivo_id na tabela contact_messages
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->unsignedBigInteger('motivo_id')->after('mensagem')->nullable();
        });

        // ✔️ Passo 4: Motivo_id se torna chave estrangeira da tabela motivos_de_contato
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->foreign('motivo_id')->references('id')->on('motivos_de_contato')->onDelete('set null');
        });

        // ✔️ Passo 5: Exclui a coluna motivo
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('motivo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // ✔️ Passo 1: Exclui a chave estrangeira
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropForeign(['motivo_id']);
        });

        // ✔️ Passo 2: Exclui a coluna motivo_id
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('motivo_id');
        });

        // ✔️ Passo 3: Restaura a coluna motivo na tabela contact_messages
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('motivo')->nullable();
        });

        // ✔️ Passo 4: Exclui os dados da tabela motivos_de_contato (se necessário)
        MotivoDeContato::truncate();

        // ✔️ Passo 5: Exclui a tabela motivos_de_contato
        DB::statement('DROP TABLE IF EXISTS motivos_de_contato;');
    }
};
