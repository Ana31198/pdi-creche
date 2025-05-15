<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CriancaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->firstName,
            'genero' => $this->faker->randomElement(['Masculino', 'Feminino']),
            'data_nascimento' => $this->faker->date('Y-m-d'),
            'nomeresponsavel' => $this->faker->name,
            'graudeparentescodoresponsavel' => $this->faker->randomElement(['Pai', 'Mãe', 'Avô', 'Avó']),
            'contactodoresponsavel' => $this->faker->phoneNumber,
            'image' => 'imgs/perfil_padrao.png', // ou um valor fake, se não for obrigatório
        ];
    }
}
