<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Zanr;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZanrControllerTest extends TestCase
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
    public function it_displays_index_view_with_zanrs(): void
    {
        $zanrs = Zanr::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('zanrs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.zanrs.index')
            ->assertViewHas('zanrs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_zanr(): void
    {
        $response = $this->get(route('zanrs.create'));

        $response->assertOk()->assertViewIs('app.zanrs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_zanr(): void
    {
        $data = Zanr::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('zanrs.store'), $data);

        $this->assertDatabaseHas('zanrs', $data);

        $zanr = Zanr::latest('ZanrId')->first();

        $response->assertRedirect(route('zanrs.edit', $zanr));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_zanr(): void
    {
        $zanr = Zanr::factory()->create();

        $response = $this->get(route('zanrs.show', $zanr));

        $response
            ->assertOk()
            ->assertViewIs('app.zanrs.show')
            ->assertViewHas('zanr');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_zanr(): void
    {
        $zanr = Zanr::factory()->create();

        $response = $this->get(route('zanrs.edit', $zanr));

        $response
            ->assertOk()
            ->assertViewIs('app.zanrs.edit')
            ->assertViewHas('zanr');
    }

    /**
     * @test
     */
    public function it_updates_the_zanr(): void
    {
        $zanr = Zanr::factory()->create();

        $data = [
            'Naziv' => $this->faker->text(50),
        ];

        $response = $this->put(route('zanrs.update', $zanr), $data);

        $data['ZanrId'] = $zanr->ZanrId;

        $this->assertDatabaseHas('zanrs', $data);

        $response->assertRedirect(route('zanrs.edit', $zanr));
    }

    /**
     * @test
     */
    public function it_deletes_the_zanr(): void
    {
        $zanr = Zanr::factory()->create();

        $response = $this->delete(route('zanrs.destroy', $zanr));

        $response->assertRedirect(route('zanrs.index'));

        $this->assertModelMissing($zanr);
    }
}
