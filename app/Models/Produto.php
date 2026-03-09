<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'unidade_id', 'fornecedor_id']; //Campos que podem ser preenchidos em massa (mass assignment)

    public function produtoDetalhe()
    {
        return $this->hasOne(ProdutoDetalhe::class); //Relacionamento um para um (hasOne)
        //A função hasOne do Laravel é usada para definir um relacionamento um para um onde o modelo atual tem um único registro relacionado em outra tabela.
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class); //Relacionamento um para muitos (belongsTo)
        //classe belongsTo do Laravel é usada para definir um relacionamento inverso de um para muitos. Ou seja, ela é utilizada em um modelo que faz referência a outro modelo. Esse relacionamento é comum quando um item de uma tabela "pertence a" um item de outra tabela.
    }

    public function pedidos() {
        return $this->belongsToMany(Pedido::class, 'pedidos_produtos');
    }
}
