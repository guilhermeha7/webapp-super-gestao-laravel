<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores'; // $table é uma propriedade que define o nome da tabela associada a este modelo, que é 'fornecedores'
    protected $fillable = ['nome', 'email', 'uf', 'site']; //$fillable é uma propriedade que define quais campos podem ser preenchidos em massa (via array associativo) no Laravel. Ou seja, ela serve para permitir a modificação desses campos quando você faz uma atribuição em massa (mass-assignment), ou seja, ao usar métodos como create(), update(), ou até mesmo fill()

    public function produtos()
    {
        return $this->hasMany(Produto::class); //Relacionamento um para muitos (hasMany)
        //A função hasMany do Laravel é usada para definir um relacionamento um para muitos onde o modelo atual pode ter vários registros relacionados em outra tabela.
    }
}
