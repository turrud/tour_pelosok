<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Home;
use App\Models\HomeImage;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeHomeImagesTest extends TestCase
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
    public function it_gets_home_home_images(): void
    {
        $home = Home::factory()->create();
        $homeImages = HomeImage::factory()
            ->count(2)
            ->create([
                'home_id' => $home->id,
            ]);

        $response = $this->getJson(route('api.homes.home-images.index', $home));

        $response->assertOk()->assertSee($homeImages[0]->caption);
    }

    /**
     * @test
     */
    public function it_stores_the_home_home_images(): void
    {
        $home = Home::factory()->create();
        $data = HomeImage::factory()
            ->make([
                'home_id' => $home->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.homes.home-images.store', $home),
            $data
        );

        unset($data['home_id']);

        $this->assertDatabaseHas('home_images', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $homeImage = HomeImage::latest('id')->first();

        $this->assertEquals($home->id, $homeImage->home_id);
    }
}
