<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Tagabout;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagaboutTest extends TestCase
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
    public function it_gets_tagabouts_list(): void
    {
        $tagabouts = Tagabout::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.tagabouts.index'));

        $response->assertOk()->assertSee($tagabouts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_tagabout(): void
    {
        $data = Tagabout::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.tagabouts.store'), $data);

        $this->assertDatabaseHas('tagabouts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_tagabout(): void
    {
        $tagabout = Tagabout::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'slug' => $this->faker->unique->slug(),
        ];

        $response = $this->putJson(
            route('api.tagabouts.update', $tagabout),
            $data
        );

        $data['id'] = $tagabout->id;

        $this->assertDatabaseHas('tagabouts', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_tagabout(): void
    {
        $tagabout = Tagabout::factory()->create();

        $response = $this->deleteJson(
            route('api.tagabouts.destroy', $tagabout)
        );

        $this->assertSoftDeleted($tagabout);

        $response->assertNoContent();
    }
}
