<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fornecedor::create([
            'nome' => 'Mei Misaki',
            'site' => 'meimisaki.com',
            'uf' => 'SP',
            'email' => 'meimisaki@outlook.com'
        ]);

        Fornecedor::create([
            'nome' => 'Aya Asagiri',
            'site' => 'aya.com',
            'uf' => 'SP',
            'email' => 'aya@outlook.com'
        ]);

        Fornecedor::create([
            'nome' => 'Lain',
            'site' => 'lain.com',
            'uf' => 'SP',
            'email' => 'lain@outlook.com'
        ]);

        Fornecedor::create([
            'nome' => 'Mei Misaki',
            'site' => 'meimisaki.com',
            'uf' => 'SP',
            'email' => 'meimisaki@outlook.com'
        ]);
    }
}
