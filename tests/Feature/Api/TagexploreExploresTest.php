<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Explore;
use App\Models\Tagexplore;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagexploreExploresTest extends TestCase
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
    public function it_gets_tagexplore_explores(): void
    {
        $tagexplore = Tagexplore::factory()->create();
        $explore = Explore::factory()->create();

        $tagexplore->explores()->attach($explore);

        $response = $this->getJson(
            route('api.tagexplores.explores.index', $tagexplore)
        );

        $response->assertOk()->assertSee($explore->title);
    }

    /**
     * @test
     */
    public function it_can_attach_explores_to_tagexplore(): void
    {
        $tagexplore = Tagexplore::factory()->create();
        $explore = Explore::factory()->create();

        $response = $this->postJson(
            route('api.tagexplores.explores.store', [$tagexplore, $explore])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $tagexplore
                ->explores()
                ->where('explores.id', $explore->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_explores_from_tagexplore(): void
    {
        $tagexplore = Tagexplore::factory()->create();
        $explore = Explore::factory()->create();

        $response = $this->deleteJson(
            route('api.tagexplores.explores.store', [$tagexplore, $explore])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $tagexplore
                ->explores()
                ->where('explores.id', $explore->id)
                ->exists()
        );
    }
}
