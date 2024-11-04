<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\About;
use App\Models\Tagabout;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagaboutAboutsTest extends TestCase
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
    public function it_gets_tagabout_abouts(): void
    {
        $tagabout = Tagabout::factory()->create();
        $about = About::factory()->create();

        $tagabout->abouts()->attach($about);

        $response = $this->getJson(
            route('api.tagabouts.abouts.index', $tagabout)
        );

        $response->assertOk()->assertSee($about->title);
    }

    /**
     * @test
     */
    public function it_can_attach_abouts_to_tagabout(): void
    {
        $tagabout = Tagabout::factory()->create();
        $about = About::factory()->create();

        $response = $this->postJson(
            route('api.tagabouts.abouts.store', [$tagabout, $about])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $tagabout
                ->abouts()
                ->where('abouts.id', $about->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_abouts_from_tagabout(): void
    {
        $tagabout = Tagabout::factory()->create();
        $about = About::factory()->create();

        $response = $this->deleteJson(
            route('api.tagabouts.abouts.store', [$tagabout, $about])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $tagabout
                ->abouts()
                ->where('abouts.id', $about->id)
                ->exists()
        );
    }
}
