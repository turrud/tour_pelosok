<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\About;
use App\Models\AboutImage;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutAboutImagesTest extends TestCase
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
    public function it_gets_about_about_images(): void
    {
        $about = About::factory()->create();
        $aboutImages = AboutImage::factory()
            ->count(2)
            ->create([
                'about_id' => $about->id,
            ]);

        $response = $this->getJson(
            route('api.abouts.about-images.index', $about)
        );

        $response->assertOk()->assertSee($aboutImages[0]->caption);
    }

    /**
     * @test
     */
    public function it_stores_the_about_about_images(): void
    {
        $about = About::factory()->create();
        $data = AboutImage::factory()
            ->make([
                'about_id' => $about->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.abouts.about-images.store', $about),
            $data
        );

        unset($data['about_id']);

        $this->assertDatabaseHas('about_images', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $aboutImage = AboutImage::latest('id')->first();

        $this->assertEquals($about->id, $aboutImage->about_id);
    }
}
