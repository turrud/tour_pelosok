<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Tagexplore;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagexploreTest extends TestCase
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
    public function it_gets_tagexplores_list(): void
    {
        $tagexplores = Tagexplore::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.tagexplores.index'));

        $response->assertOk()->assertSee($tagexplores[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_tagexplore(): void
    {
        $data = Tagexplore::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.tagexplores.store'), $data);

        $this->assertDatabaseHas('tagexplores', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_tagexplore(): void
    {
        $tagexplore = Tagexplore::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'slug' => $this->faker->unique->slug(),
        ];

        $response = $this->putJson(
            route('api.tagexplores.update', $tagexplore),
            $data
        );

        $data['id'] = $tagexplore->id;

        $this->assertDatabaseHas('tagexplores', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_tagexplore(): void
    {
        $tagexplore = Tagexplore::factory()->create();

        $response = $this->deleteJson(
            route('api.tagexplores.destroy', $tagexplore)
        );

        $this->assertSoftDeleted($tagexplore);

        $response->assertNoContent();
    }
}
