<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Scena;
use App\Models\Film;
use App\Models\Zaposleni;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScenaEmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_assign_and_remove_employees_from_scene()
    {
        // Create a film
        $film = Film::factory()->create();

        // Create a scene
        $scene = Scena::factory()->create([
            'film_id' => $film->FilmId,
            'Lokacija' => 'Test Location',
            'DatumSnimanja' => '2025-08-01'
        ]);

        // Create two employees
        $employee1 = Zaposleni::factory()->create([
            'Status' => 'aktivan'
        ]);
        $employee2 = Zaposleni::factory()->create([
            'Status' => 'aktivan'
        ]);

        // Assert initial state
        $this->assertEquals(0, $scene->zaposlenis()->count());

        // Assign employees to scene
        $scene->zaposlenis()->attach($employee1->ZaposleniId);
        $scene->zaposlenis()->attach($employee2->ZaposleniId);

        // Assert employees were attached
        $this->assertEquals(2, $scene->zaposlenis()->count());
        $this->assertTrue($scene->zaposlenis->contains($employee1));
        $this->assertTrue($scene->zaposlenis->contains($employee2));

        // Remove one employee
        $scene->zaposlenis()->detach($employee1->ZaposleniId);

        // Assert employee was removed
        $this->assertEquals(1, $scene->zaposlenis()->count());
        $this->assertFalse($scene->zaposlenis->contains($employee1));
        $this->assertTrue($scene->zaposlenis->contains($employee2));
    }
}
