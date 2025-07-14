<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Film;
use App\Models\Scena;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilmScenasTest extends TestCase
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
    public function it_gets_film_scenas(): void
    {
        $film = Film::factory()->create();
        $scenas = Scena::factory()
            ->count(2)
            ->create([
                'film_id' => $film->FilmId,
            ]);

        $response = $this->getJson(route('api.films.scenas.index', $film));

        $response->assertOk()->assertSee($scenas[0]->Lokacija);
    }

    /**
     * @test
     */
    public function it_stores_the_film_scenas(): void
    {
        $film = Film::factory()->create();
        $data = Scena::factory()
            ->make([
                'film_id' => $film->FilmId,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.films.scenas.store', $film),
            $data
        );

        $this->assertDatabaseHas('scenas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $scena = Scena::latest('ScenaId')->first();

        $this->assertEquals($film->FilmId, $scena->film_id);
    }
}
