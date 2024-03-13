<?php

namespace Database\Factories;

use App\Models\Desenvolvedor;
use App\Models\Nivel;
use Illuminate\Database\Eloquent\Factories\Factory;

class DesenvolvedorFactory extends Factory
{
    protected $model = Desenvolvedor::class;

    public function definition()
    {
        return [
            'nivel_id' => Nivel::factory(),
            'nome' => $this->faker->name,
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'datanascimento' => $this->faker->date(),
            'hobby' => $this->faker->sentence,
        ];
    }
}
