<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Explore;
use App\Models\Tagexplore;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExploreTagexploresTest extends TestCase
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
    public function it_gets_explore_tagexplores(): void
    {
        $explore = Explore::factory()->create();
        $tagexplore = Tagexplore::factory()->create();

        $explore->tagexplores()->attach($tagexplore);

        $response = $this->getJson(
            route('api.explores.tagexplores.index', $explore)
        );

        $response->assertOk()->assertSee($tagexplore->name);
    }

    /**
     * @test
     */
    public function it_can_attach_tagexplores_to_explore(): void
    {
        $explore = Explore::factory()->create();
        $tagexplore = Tagexplore::factory()->create();

        $response = $this->postJson(
            route('api.explores.tagexplores.store', [$explore, $tagexplore])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $explore
                ->tagexplores()
                ->where('tagexplores.id', $tagexplore->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_tagexplores_from_explore(): void
    {
        $explore = Explore::factory()->create();
        $tagexplore = Tagexplore::factory()->create();

        $response = $this->deleteJson(
            route('api.explores.tagexplores.store', [$explore, $tagexplore])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $explore
                ->tagexplores()
                ->where('tagexplores.id', $tagexplore->id)
                ->exists()
        );
    }
}
