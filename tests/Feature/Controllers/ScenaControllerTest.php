<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Scena;

use App\Models\Film;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScenaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_scenas(): void
    {
        $scenas = Scena::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('scenas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.scenas.index')
            ->assertViewHas('scenas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_scena(): void
    {
        $response = $this->get(route('scenas.create'));

        $response->assertOk()->assertViewIs('app.scenas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_scena(): void
    {
        $data = Scena::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('scenas.store'), $data);

        $this->assertDatabaseHas('scenas', $data);

        $scena = Scena::latest('ScenaId')->first();

        $response->assertRedirect(route('scenas.edit', $scena));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_scena(): void
    {
        $scena = Scena::factory()->create();

        $response = $this->get(route('scenas.show', $scena));

        $response
            ->assertOk()
            ->assertViewIs('app.scenas.show')
            ->assertViewHas('scena');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_scena(): void
    {
        $scena = Scena::factory()->create();

        $response = $this->get(route('scenas.edit', $scena));

        $response
            ->assertOk()
            ->assertViewIs('app.scenas.edit')
            ->assertViewHas('scena');
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

        $response = $this->put(route('scenas.update', $scena), $data);

        $data['ScenaId'] = $scena->ScenaId;

        $this->assertDatabaseHas('scenas', $data);

        $response->assertRedirect(route('scenas.edit', $scena));
    }

    /**
     * @test
     */
    public function it_deletes_the_scena(): void
    {
        $scena = Scena::factory()->create();

        $response = $this->delete(route('scenas.destroy', $scena));

        $response->assertRedirect(route('scenas.index'));

        $this->assertModelMissing($scena);
    }
}
