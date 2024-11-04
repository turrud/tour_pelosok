<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\About;
use App\Models\Tagabout;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutTagaboutsTest extends TestCase
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
    public function it_gets_about_tagabouts(): void
    {
        $about = About::factory()->create();
        $tagabout = Tagabout::factory()->create();

        $about->tagabouts()->attach($tagabout);

        $response = $this->getJson(route('api.abouts.tagabouts.index', $about));

        $response->assertOk()->assertSee($tagabout->name);
    }

    /**
     * @test
     */
    public function it_can_attach_tagabouts_to_about(): void
    {
        $about = About::factory()->create();
        $tagabout = Tagabout::factory()->create();

        $response = $this->postJson(
            route('api.abouts.tagabouts.store', [$about, $tagabout])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $about
                ->tagabouts()
                ->where('tagabouts.id', $tagabout->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_tagabouts_from_about(): void
    {
        $about = About::factory()->create();
        $tagabout = Tagabout::factory()->create();

        $response = $this->deleteJson(
            route('api.abouts.tagabouts.store', [$about, $tagabout])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $about
                ->tagabouts()
                ->where('tagabouts.id', $tagabout->id)
                ->exists()
        );
    }
}
