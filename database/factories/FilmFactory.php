<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Naziv' => $this->faker->text(100),
            'Status' => $this->faker->word(),
            'Budzet' => 'predprodukcija',
            'DatumIzlaska' => $this->faker->date(),
            'zanr_id' => \App\Models\Zanr::factory(),
        ];
    }
}
