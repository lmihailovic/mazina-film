<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Scena;

use App\Models\Film;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScenaTest extends TestCase
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
    public function it_gets_scenas_list(): void
    {
        $scenas = Scena::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.scenas.index'));

        $response->assertOk()->assertSee($scenas[0]->Lokacija);
    }

    /**
     * @test
     */
    public function it_stores_the_scena(): void
    {
        $data = Scena::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.scenas.store'), $data);

        $this->assertDatabaseHas('scenas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_scena(): void
    {
        $scena = Scena::factory()->create();

        $film = Film::factory()->create();

        $data = [
            'Lokacija' => $this->faker->text(255),
            'DatumSnimanja' => $this->faker->date(),
            'film_id' => $film->FilmId,
        ];

        $response = $this->putJson(route('api.scenas.update', $scena), $data);

        $data['ScenaId'] = $scena->ScenaId;

        $this->assertDatabaseHas('scenas', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_scena(): void
    {
        $scena = Scena::factory()->create();

        $response = $this->deleteJson(route('api.scenas.destroy', $scena));

        $this->assertModelMissing($scena);

        $response->assertNoContent();
    }
}
