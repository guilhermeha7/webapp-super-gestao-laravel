<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ContactMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        // Cria o gerador de dados aleatórios brasileiros
        $faker = \Faker\Factory::create('pt_BR');

        return [
            'nome' => $faker->name(), // Gera um nome aleatório em português
            'email' => $faker->unique()->email(), // Gera um email único
            'mensagem' => $faker->text(), // Gera um texto aleatório
            'motivo' => $faker->numberBetween(1, 4), // Gera um número aleatório entre 1 e 4
            'telefone' => $faker->phoneNumber(), // Gera um número de telefone no formato brasileiro
        ];
    }
}
