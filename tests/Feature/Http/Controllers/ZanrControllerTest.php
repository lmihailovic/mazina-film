<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Zanr;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ZanrController
 */
final class ZanrControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $zanrs = Zanr::factory()->count(3)->create();

        $response = $this->get(route('zanrs.index'));

        $response->assertOk();
        $response->assertViewIs('zanr.index');
        $response->assertViewHas('zanrs');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('zanrs.create'));

        $response->assertOk();
        $response->assertViewIs('zanr.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ZanrController::class,
            'store',
            \App\Http\Requests\ZanrStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $Naziv = fake()->word();

        $response = $this->post(route('zanrs.store'), [
            'Naziv' => $Naziv,
        ]);

        $zanrs = Zanr::query()
            ->where('Naziv', $Naziv)
            ->get();
        $this->assertCount(1, $zanrs);
        $zanr = $zanrs->first();

        $response->assertRedirect(route('zanrs.index'));
        $response->assertSessionHas('zanr.id', $zanr->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $zanr = Zanr::factory()->create();

        $response = $this->get(route('zanrs.show', $zanr));

        $response->assertOk();
        $response->assertViewIs('zanr.show');
        $response->assertViewHas('zanr');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $zanr = Zanr::factory()->create();

        $response = $this->get(route('zanrs.edit', $zanr));

        $response->assertOk();
        $response->assertViewIs('zanr.edit');
        $response->assertViewHas('zanr');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ZanrController::class,
            'update',
            \App\Http\Requests\ZanrUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $zanr = Zanr::factory()->create();
        $Naziv = fake()->word();

        $response = $this->put(route('zanrs.update', $zanr), [
            'Naziv' => $Naziv,
        ]);

        $zanr->refresh();

        $response->assertRedirect(route('zanrs.index'));
        $response->assertSessionHas('zanr.id', $zanr->id);

        $this->assertEquals($Naziv, $zanr->Naziv);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $zanr = Zanr::factory()->create();

        $response = $this->delete(route('zanrs.destroy', $zanr));

        $response->assertRedirect(route('zanrs.index'));

        $this->assertModelMissing($zanr);
    }
}
