<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Film;

use App\Models\Zanr;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilmControllerTest extends TestCase
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
    public function it_displays_index_view_with_films(): void
    {
        $films = Film::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('films.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.films.index')
            ->assertViewHas('films');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_film(): void
    {
        $response = $this->get(route('films.create'));

        $response->assertOk()->assertViewIs('app.films.create');
    }

    /**
     * @test
     */
    public function it_stores_the_film(): void
    {
        $data = Film::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('films.store'), $data);

        $this->assertDatabaseHas('films', $data);

        $film = Film::latest('FilmId')->first();

        $response->assertRedirect(route('films.edit', $film));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_film(): void
    {
        $film = Film::factory()->create();

        $response = $this->get(route('films.show', $film));

        $response
            ->assertOk()
            ->assertViewIs('app.films.show')
            ->assertViewHas('film');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_film(): void
    {
        $film = Film::factory()->create();

        $response = $this->get(route('films.edit', $film));

        $response
            ->assertOk()
            ->assertViewIs('app.films.edit')
            ->assertViewHas('film');
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
            'Budzet' => 'predprodukcija',
            'DatumIzlaska' => $this->faker->date(),
            'zanr_id' => $zanr->ZanrId,
        ];

        $response = $this->put(route('films.update', $film), $data);

        $data['FilmId'] = $film->FilmId;

        $this->assertDatabaseHas('films', $data);

        $response->assertRedirect(route('films.edit', $film));
    }

    /**
     * @test
     */
    public function it_deletes_the_film(): void
    {
        $film = Film::factory()->create();

        $response = $this->delete(route('films.destroy', $film));

        $response->assertRedirect(route('films.index'));

        $this->assertModelMissing($film);
    }
}
