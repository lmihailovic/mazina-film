<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Film;

use App\Models\Zanr;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilmTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_films_list(): void
    {
        $films = Film::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.films.index'));

        $response->assertOk()->assertSee($films[0]->Naziv);
    }

    /**
     * @test
     */
    public function it_stores_the_film(): void
    {
        $data = Film::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.films.store'), $data);

        $this->assertDatabaseHas('films', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_film(): void
    {
        $film = Film::factory()->create();

        $zanr = Zanr::factory()->create();

        $data = [
            'Naziv' => $this->faker->text(100),
            'Status' => $this->faker->word(),
            'Budzet' => 104532.24,
            'DatumIzlaska' => $this->faker->date(),
            'zanr_id' => $zanr->ZanrId,
        ];

        $response = $this->putJson(route('api.films.update', $film), $data);

        $data['FilmId'] = $film->FilmId;

        $this->assertDatabaseHas('films', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_film(): void
    {
        $film = Film::factory()->create();

        $response = $this->deleteJson(route('api.films.destroy', $film));

        $this->assertModelMissing($film);

        $response->assertNoContent();
    }
}
