<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Zaposleni;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZaposleniTest extends TestCase
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
    public function it_gets_zaposlenis_list(): void
    {
        $zaposlenis = Zaposleni::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.zaposlenis.index'));

        $response->assertOk()->assertSee($zaposlenis[0]->Ime);
    }

    /**
     * @test
     */
    public function it_stores_the_zaposleni(): void
    {
        $data = Zaposleni::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.zaposlenis.store'), $data);

        $this->assertDatabaseHas('zaposlenis', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_zaposleni(): void
    {
        $zaposleni = Zaposleni::factory()->create();

        $data = [
            'Ime' => $this->faker->text(20),
            'Prezime' => $this->faker->text(20),
            'Uloga' => $this->faker->text(255),
            'Status' => 'aktivan',
        ];

        $response = $this->putJson(
            route('api.zaposlenis.update', $zaposleni),
            $data
        );

        $data['ZaposleniId'] = $zaposleni->ZaposleniId;

        $this->assertDatabaseHas('zaposlenis', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_zaposleni(): void
    {
        $zaposleni = Zaposleni::factory()->create();

        $response = $this->deleteJson(
            route('api.zaposlenis.destroy', $zaposleni)
        );

        $this->assertModelMissing($zaposleni);

        $response->assertNoContent();
    }
}
