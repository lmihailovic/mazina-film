<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Film;
use App\Models\Zanr;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FilmController
 */
final class FilmControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $films = Film::factory()->count(3)->create();

        $response = $this->get(route('films.index'));

        $response->assertOk();
        $response->assertViewIs('film.index');
        $response->assertViewHas('films');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('films.create'));

        $response->assertOk();
        $response->assertViewIs('film.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FilmController::class,
            'store',
            \App\Http\Requests\FilmStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $zanr = Zanr::factory()->create();
        $Naziv = fake()->word();
        $Status = fake()->randomElement(/** enum_attributes **/);
        $Budzet = fake()->randomFloat(/** decimal_attributes **/);
        $DatumIzlaska = Carbon::parse(fake()->date());

        $response = $this->post(route('films.store'), [
            'zanr_id' => $zanr->id,
            'Naziv' => $Naziv,
            'Status' => $Status,
            'Budzet' => $Budzet,
            'DatumIzlaska' => $DatumIzlaska->toDateString(),
        ]);

        $films = Film::query()
            ->where('zanr_id', $zanr->id)
            ->where('Naziv', $Naziv)
            ->where('Status', $Status)
            ->where('Budzet', $Budzet)
            ->where('DatumIzlaska', $DatumIzlaska)
            ->get();
        $this->assertCount(1, $films);
        $film = $films->first();

        $response->assertRedirect(route('films.index'));
        $response->assertSessionHas('film.id', $film->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $film = Film::factory()->create();

        $response = $this->get(route('films.show', $film));

        $response->assertOk();
        $response->assertViewIs('film.show');
        $response->assertViewHas('film');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $film = Film::factory()->create();

        $response = $this->get(route('films.edit', $film));

        $response->assertOk();
        $response->assertViewIs('film.edit');
        $response->assertViewHas('film');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FilmController::class,
            'update',
            \App\Http\Requests\FilmUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $film = Film::factory()->create();
        $zanr = Zanr::factory()->create();
        $Naziv = fake()->word();
        $Status = fake()->randomElement(/** enum_attributes **/);
        $Budzet = fake()->randomFloat(/** decimal_attributes **/);
        $DatumIzlaska = Carbon::parse(fake()->date());

        $response = $this->put(route('films.update', $film), [
            'zanr_id' => $zanr->id,
            'Naziv' => $Naziv,
            'Status' => $Status,
            'Budzet' => $Budzet,
            'DatumIzlaska' => $DatumIzlaska->toDateString(),
        ]);

        $film->refresh();

        $response->assertRedirect(route('films.index'));
        $response->assertSessionHas('film.id', $film->id);

        $this->assertEquals($zanr->id, $film->zanr_id);
        $this->assertEquals($Naziv, $film->Naziv);
        $this->assertEquals($Status, $film->Status);
        $this->assertEquals($Budzet, $film->Budzet);
        $this->assertEquals($DatumIzlaska, $film->DatumIzlaska);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $film = Film::factory()->create();

        $response = $this->delete(route('films.destroy', $film));

        $response->assertRedirect(route('films.index'));

        $this->assertModelMissing($film);
    }
}
