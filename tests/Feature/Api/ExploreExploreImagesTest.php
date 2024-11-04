<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Explore;
use App\Models\ExploreImage;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExploreExploreImagesTest extends TestCase
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
    public function it_gets_explore_explore_images(): void
    {
        $explore = Explore::factory()->create();
        $exploreImages = ExploreImage::factory()
            ->count(2)
            ->create([
                'explore_id' => $explore->id,
            ]);

        $response = $this->getJson(
            route('api.explores.explore-images.index', $explore)
        );

        $response->assertOk()->assertSee($exploreImages[0]->caption);
    }

    /**
     * @test
     */
    public function it_stores_the_explore_explore_images(): void
    {
        $explore = Explore::factory()->create();
        $data = ExploreImage::factory()
            ->make([
                'explore_id' => $explore->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.explores.explore-images.store', $explore),
            $data
        );

        unset($data['explore_id']);

        $this->assertDatabaseHas('explore_images', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $exploreImage = ExploreImage::latest('id')->first();

        $this->assertEquals($explore->id, $exploreImage->explore_id);
    }
}
