<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Film;
use App\Models\Scena;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ScenaController
 */
final class ScenaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $scenas = Scena::factory()->count(3)->create();

        $response = $this->get(route('scenas.index'));

        $response->assertOk();
        $response->assertViewIs('scena.index');
        $response->assertViewHas('scenas');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('scenas.create'));

        $response->assertOk();
        $response->assertViewIs('scena.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ScenaController::class,
            'store',
            \App\Http\Requests\ScenaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $film = Film::factory()->create();
        $Lokacija = fake()->word();
        $DatumSnimanja = Carbon::parse(fake()->date());

        $response = $this->post(route('scenas.store'), [
            'film_id' => $film->id,
            'Lokacija' => $Lokacija,
            'DatumSnimanja' => $DatumSnimanja->toDateString(),
        ]);

        $scenas = Scena::query()
            ->where('film_id', $film->id)
            ->where('Lokacija', $Lokacija)
            ->where('DatumSnimanja', $DatumSnimanja)
            ->get();
        $this->assertCount(1, $scenas);
        $scena = $scenas->first();

        $response->assertRedirect(route('scenas.index'));
        $response->assertSessionHas('scena.id', $scena->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $scena = Scena::factory()->create();

        $response = $this->get(route('scenas.show', $scena));

        $response->assertOk();
        $response->assertViewIs('scena.show');
        $response->assertViewHas('scena');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $scena = Scena::factory()->create();

        $response = $this->get(route('scenas.edit', $scena));

        $response->assertOk();
        $response->assertViewIs('scena.edit');
        $response->assertViewHas('scena');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ScenaController::class,
            'update',
            \App\Http\Requests\ScenaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $scena = Scena::factory()->create();
        $film = Film::factory()->create();
        $Lokacija = fake()->word();
        $DatumSnimanja = Carbon::parse(fake()->date());

        $response = $this->put(route('scenas.update', $scena), [
            'film_id' => $film->id,
            'Lokacija' => $Lokacija,
            'DatumSnimanja' => $DatumSnimanja->toDateString(),
        ]);

        $scena->refresh();

        $response->assertRedirect(route('scenas.index'));
        $response->assertSessionHas('scena.id', $scena->id);

        $this->assertEquals($film->id, $scena->film_id);
        $this->assertEquals($Lokacija, $scena->Lokacija);
        $this->assertEquals($DatumSnimanja, $scena->DatumSnimanja);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $scena = Scena::factory()->create();

        $response = $this->delete(route('scenas.destroy', $scena));

        $response->assertRedirect(route('scenas.index'));

        $this->assertModelMissing($scena);
    }
}
