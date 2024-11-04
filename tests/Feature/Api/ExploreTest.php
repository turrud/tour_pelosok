<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Explore;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExploreTest extends TestCase
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
    public function it_gets_explores_list(): void
    {
        $explores = Explore::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.explores.index'));

        $response->assertOk()->assertSee($explores[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_explore(): void
    {
        $data = Explore::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.explores.store'), $data);

        $this->assertDatabaseHas('explores', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_explore(): void
    {
        $explore = Explore::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
            'main_image' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.explores.update', $explore),
            $data
        );

        $data['id'] = $explore->id;

        $this->assertDatabaseHas('explores', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_explore(): void
    {
        $explore = Explore::factory()->create();

        $response = $this->deleteJson(route('api.explores.destroy', $explore));

        $this->assertSoftDeleted($explore);

        $response->assertNoContent();
    }
}
