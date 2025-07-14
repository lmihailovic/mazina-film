<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Zaposleni;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ZaposleniController
 */
final class ZaposleniControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $zaposlenis = Zaposleni::factory()->count(3)->create();

        $response = $this->get(route('zaposlenis.index'));

        $response->assertOk();
        $response->assertViewIs('zaposleni.index');
        $response->assertViewHas('zaposlenis');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('zaposlenis.create'));

        $response->assertOk();
        $response->assertViewIs('zaposleni.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ZaposleniController::class,
            'store',
            \App\Http\Requests\ZaposleniStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $Ime = fake()->word();
        $Prezime = fake()->word();
        $Uloga = fake()->word();
        $Status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('zaposlenis.store'), [
            'Ime' => $Ime,
            'Prezime' => $Prezime,
            'Uloga' => $Uloga,
            'Status' => $Status,
        ]);

        $zaposlenis = Zaposleni::query()
            ->where('Ime', $Ime)
            ->where('Prezime', $Prezime)
            ->where('Uloga', $Uloga)
            ->where('Status', $Status)
            ->get();
        $this->assertCount(1, $zaposlenis);
        $zaposleni = $zaposlenis->first();

        $response->assertRedirect(route('zaposlenis.index'));
        $response->assertSessionHas('zaposleni.id', $zaposleni->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $zaposleni = Zaposleni::factory()->create();

        $response = $this->get(route('zaposlenis.show', $zaposleni));

        $response->assertOk();
        $response->assertViewIs('zaposleni.show');
        $response->assertViewHas('zaposleni');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $zaposleni = Zaposleni::factory()->create();

        $response = $this->get(route('zaposlenis.edit', $zaposleni));

        $response->assertOk();
        $response->assertViewIs('zaposleni.edit');
        $response->assertViewHas('zaposleni');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ZaposleniController::class,
            'update',
            \App\Http\Requests\ZaposleniUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $zaposleni = Zaposleni::factory()->create();
        $Ime = fake()->word();
        $Prezime = fake()->word();
        $Uloga = fake()->word();
        $Status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('zaposlenis.update', $zaposleni), [
            'Ime' => $Ime,
            'Prezime' => $Prezime,
            'Uloga' => $Uloga,
            'Status' => $Status,
        ]);

        $zaposleni->refresh();

        $response->assertRedirect(route('zaposlenis.index'));
        $response->assertSessionHas('zaposleni.id', $zaposleni->id);

        $this->assertEquals($Ime, $zaposleni->Ime);
        $this->assertEquals($Prezime, $zaposleni->Prezime);
        $this->assertEquals($Uloga, $zaposleni->Uloga);
        $this->assertEquals($Status, $zaposleni->Status);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $zaposleni = Zaposleni::factory()->create();

        $response = $this->delete(route('zaposlenis.destroy', $zaposleni));

        $response->assertRedirect(route('zaposlenis.index'));

        $this->assertModelMissing($zaposleni);
    }
}
