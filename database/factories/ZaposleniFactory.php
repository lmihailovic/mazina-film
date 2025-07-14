<?php

namespace Database\Factories;

use App\Models\Zaposleni;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZaposleniFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Zaposleni::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Ime' => $this->faker->text(20),
            'Prezime' => $this->faker->text(20),
            'Uloga' => $this->faker->text(255),
            'Status' => 'aktivan',
        ];
    }
}
