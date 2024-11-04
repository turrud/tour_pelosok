<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Home;
use App\Models\Taghome;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTaghomesTest extends TestCase
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
    public function it_gets_home_taghomes(): void
    {
        $home = Home::factory()->create();
        $taghome = Taghome::factory()->create();

        $home->taghomes()->attach($taghome);

        $response = $this->getJson(route('api.homes.taghomes.index', $home));

        $response->assertOk()->assertSee($taghome->name);
    }

    /**
     * @test
     */
    public function it_can_attach_taghomes_to_home(): void
    {
        $home = Home::factory()->create();
        $taghome = Taghome::factory()->create();

        $response = $this->postJson(
            route('api.homes.taghomes.store', [$home, $taghome])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $home
                ->taghomes()
                ->where('taghomes.id', $taghome->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_taghomes_from_home(): void
    {
        $home = Home::factory()->create();
        $taghome = Taghome::factory()->create();

        $response = $this->deleteJson(
            route('api.homes.taghomes.store', [$home, $taghome])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $home
                ->taghomes()
                ->where('taghomes.id', $taghome->id)
                ->exists()
        );
    }
}
