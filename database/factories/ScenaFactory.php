<?php

namespace Database\Factories;

use App\Models\Scena;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScenaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Scena::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Lokacija' => $this->faker->text(255),
            'DatumSnimanja' => $this->faker->date(),
            'film_id' => \App\Models\Film::factory(),
        ];
    }
}
