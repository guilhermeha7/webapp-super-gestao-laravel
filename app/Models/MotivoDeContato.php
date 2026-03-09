<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotivoDeContato extends Model
{
    protected $table = 'motivos_de_contato';
    protected $fillable = ['motivo'];
}
