<?php

namespace Database\Factories;

use App\Models\Zanr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZanrFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Zanr::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Naziv' => $this->faker->text(50),
        ];
    }
}
