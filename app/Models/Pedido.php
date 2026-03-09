<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['cliente_id'];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function produtos() {
        return $this->belongsToMany(Produto::class, 'pedidos_produtos')->withPivot('created_at', 'id'); //withPivot(coluna): por padrão o Laravel não consegue acessar todas as colunas da tabela intermediária (pedidos_produtos) na consulta. O método withPivot() é usado para especificar quais colunas da tabela intermediária devem ser incluídas na consulta. Neste caso, estamos incluindo a coluna created_at também teremos acesso à data de criação do registro na tabela pedidos_produtos por meio do objeto pivot (ex: $produto->pivot->created_at).
    }
}
