<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Scena;
use App\Models\Zaposleni;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScenaZaposlenisTest extends TestCase
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
    public function it_gets_scena_zaposlenis(): void
    {
        $scena = Scena::factory()->create();
        $zaposleni = Zaposleni::factory()->create();

        $scena->zaposlenis()->attach($zaposleni);

        $response = $this->getJson(
            route('api.scenas.zaposlenis.index', $scena)
        );

        $response->assertOk()->assertSee($zaposleni->Ime);
    }

    /**
     * @test
     */
    public function it_can_attach_zaposlenis_to_scena(): void
    {
        $scena = Scena::factory()->create();
        $zaposleni = Zaposleni::factory()->create();

        $response = $this->postJson(
            route('api.scenas.zaposlenis.store', [$scena, $zaposleni])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $scena
                ->zaposlenis()
                ->where('zaposlenis.ZaposleniId', $zaposleni->ZaposleniId)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_zaposlenis_from_scena(): void
    {
        $scena = Scena::factory()->create();
        $zaposleni = Zaposleni::factory()->create();

        $response = $this->deleteJson(
            route('api.scenas.zaposlenis.store', [$scena, $zaposleni])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $scena
                ->zaposlenis()
                ->where('zaposlenis.ZaposleniId', $zaposleni->ZaposleniId)
                ->exists()
        );
    }
}
