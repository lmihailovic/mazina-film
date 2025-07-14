<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Zanr;
use App\Models\Film;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZanrFilmsTest extends TestCase
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
    public function it_gets_zanr_films(): void
    {
        $zanr = Zanr::factory()->create();
        $films = Film::factory()
            ->count(2)
            ->create([
                'zanr_id' => $zanr->ZanrId,
            ]);

        $response = $this->getJson(route('api.zanrs.films.index', $zanr));

        $response->assertOk()->assertSee($films[0]->Naziv);
    }

    /**
     * @test
     */
    public function it_stores_the_zanr_films(): void
    {
        $zanr = Zanr::factory()->create();
        $data = Film::factory()
            ->make([
                'zanr_id' => $zanr->ZanrId,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.zanrs.films.store', $zanr),
            $data
        );

        $this->assertDatabaseHas('films', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $film = Film::latest('FilmId')->first();

        $this->assertEquals($zanr->ZanrId, $film->zanr_id);
    }
}
