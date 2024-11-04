<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Home;
use App\Models\Taghome;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaghomeHomesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_taghome_homes(): void
    {
        $taghome = Taghome::factory()->create();
        $home = Home::factory()->create();

        $taghome->homes()->attach($home);

        $response = $this->getJson(route('api.taghomes.homes.index', $taghome));

        $response->assertOk()->assertSee($home->title);
    }

    /**
     * @test
     */
    public function it_can_attach_homes_to_taghome(): void
    {
        $taghome = Taghome::factory()->create();
        $home = Home::factory()->create();

        $response = $this->postJson(
            route('api.taghomes.homes.store', [$taghome, $home])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $taghome
                ->homes()
                ->where('homes.id', $home->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_homes_from_taghome(): void
    {
        $taghome = Taghome::factory()->create();
        $home = Home::factory()->create();

        $response = $this->deleteJson(
            route('api.taghomes.homes.store', [$taghome, $home])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $taghome
                ->homes()
                ->where('homes.id', $home->id)
                ->exists()
        );
    }
}
