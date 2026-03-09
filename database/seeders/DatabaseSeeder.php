<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\ContactMessagesFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(FornecedorSeeder::class); //Executa o método run da classe FornecedorSeeder ao escrever php artisan db:seed 
        $this->call(ContactMessageSeeder::class);
    }
}
