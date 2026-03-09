<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    protected $table = 'contact_messages';
    protected $fillable = ['nome', 'email', 'telefone', 'motivo_id', 'mensagem']; //Permite a atribuição em massa dos campos nome, email, telefone, motivo_id e mensagem. Isso é necessário para usar o método create() no controlador, que recebe um array de dados e tenta criar um registro no banco de dados com esses dados. Se os campos não estiverem listados em $fillable, o Laravel não permitirá a criação do registro por questões de segurança (mass assignment protection).
    use HasFactory; //Permite o método `ContactMessage::factory()` chamar a factory/gerador de ContactMessage automaticamente (ContactMessageFactory).
}   
