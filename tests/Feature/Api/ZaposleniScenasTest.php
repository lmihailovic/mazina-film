<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Scena;
use App\Models\Zaposleni;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZaposleniScenasTest extends TestCase
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
    public function it_gets_zaposleni_scenas(): void
    {
        $zaposleni = Zaposleni::factory()->create();
        $scena = Scena::factory()->create();

        $zaposleni->scenas()->attach($scena);

        $response = $this->getJson(
            route('api.zaposlenis.scenas.index', $zaposleni)
        );

        $response->assertOk()->assertSee($scena->Lokacija);
    }

    /**
     * @test
     */
    public function it_can_attach_scenas_to_zaposleni(): void
    {
        $zaposleni = Zaposleni::factory()->create();
        $scena = Scena::factory()->create();

        $response = $this->postJson(
            route('api.zaposlenis.scenas.store', [$zaposleni, $scena])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $zaposleni
                ->scenas()
                ->where('scenas.ScenaId', $scena->ScenaId)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_scenas_from_zaposleni(): void
    {
        $zaposleni = Zaposleni::factory()->create();
        $scena = Scena::factory()->create();

        $response = $this->deleteJson(
            route('api.zaposlenis.scenas.store', [$zaposleni, $scena])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $zaposleni
                ->scenas()
                ->where('scenas.ScenaId', $scena->ScenaId)
                ->exists()
        );
    }
}
