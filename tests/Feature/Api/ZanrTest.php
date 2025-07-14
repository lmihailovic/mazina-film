<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Zanr;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZanrTest extends TestCase
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
    public function it_gets_zanrs_list(): void
    {
        $zanrs = Zanr::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.zanrs.index'));

        $response->assertOk()->assertSee($zanrs[0]->Naziv);
    }

    /**
     * @test
     */
    public function it_stores_the_zanr(): void
    {
        $data = Zanr::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.zanrs.store'), $data);

        $this->assertDatabaseHas('zanrs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.zanrs.update', $zanr), $data);

        $data['ZanrId'] = $zanr->ZanrId;

        $this->assertDatabaseHas('zanrs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_zanr(): void
    {
        $zanr = Zanr::factory()->create();

        $response = $this->deleteJson(route('api.zanrs.destroy', $zanr));

        $this->assertModelMissing($zanr);

        $response->assertNoContent();
    }
}
