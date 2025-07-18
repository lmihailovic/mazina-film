<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Scena;
use App\Models\Film;
use App\Models\Zaposleni;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;

class ScenaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factorcy()->create(['email' => 'admin@admin.com']);
        $this->actingAs($user);

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function it_can_display_scenes_index()
    {
        $scenes = Scena::factory()->count(3)->create();

        $response = $this->get(route('scenas.index'));

        $response->assertOk()
            ->assertViewIs('app.scenas.index')
            ->assertViewHas('scenas');
    }

    /** @test */
    public function it_can_create_scene()
    {
        $film = Film::factory()->create();

        $sceneData = [
            'film_id' => $film->FilmId,
            'Lokacija' => 'Test Location',
            'DatumSnimanja' => '2025-08-01',
        ];

        $response = $this->post(route('scenas.store'), $sceneData);

        $this->assertDatabaseHas('scenas', $sceneData);
        $scene = Scena::latest('ScenaId')->first();

        $response->assertRedirect(route('scenas.edit', $scene));
    }

    /** @test */
    public function it_can_assign_employee_to_scene()
    {
        $scene = Scena::factory()->create();
        $employee = Zaposleni::factory()->create(['Status' => 'aktivan']);

        $response = $this->put(route('scenas.update', $scene), [
            'action' => 'hire',
            'zaposleni_id' => $employee->ZaposleniId
        ]);

        $response->assertRedirect(route('scenas.edit', $scene));
        $this->assertTrue($scene->zaposlenis->contains($employee));
    }

    /** @test */
    public function it_can_remove_employee_from_scene()
    {
        $scene = Scena::factory()->create();
        $employee = Zaposleni::factory()->create(['Status' => 'aktivan']);

        // First attach the employee
        $scene->zaposlenis()->attach($employee->ZaposleniId);

        $response = $this->put(route('scenas.update', $scene), [
            'action' => 'release',
            'zaposleni_id' => $employee->ZaposleniId
        ]);

        $response->assertRedirect(route('scenas.edit', $scene));
        $this->assertFalse($scene->zaposlenis->contains($employee));
    }

    /** @test */
    public function it_can_update_scene_details()
    {
        $scene = Scena::factory()->create();
        $film = Film::factory()->create();

        $updateData = [
            'film_id' => $film->FilmId,
            'Lokacija' => 'Updated Location',
            'DatumSnimanja' => '2025-09-01',
        ];

        $response = $this->put(route('scenas.update', $scene), $updateData);

        $response->assertRedirect(route('scenas.edit', $scene));
        $this->assertDatabaseHas('scenas', array_merge(
            ['ScenaId' => $scene->ScenaId],
            $updateData
        ));
    }
}
