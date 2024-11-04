<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Home;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
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
    public function it_gets_homes_list(): void
    {
        $homes = Home::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.homes.index'));

        $response->assertOk()->assertSee($homes[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_home(): void
    {
        $data = Home::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.homes.store'), $data);

        $this->assertDatabaseHas('homes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_home(): void
    {
        $home = Home::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->putJson(route('api.homes.update', $home), $data);

        $data['id'] = $home->id;

        $this->assertDatabaseHas('homes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_home(): void
    {
        $home = Home::factory()->create();

        $response = $this->deleteJson(route('api.homes.destroy', $home));

        $this->assertSoftDeleted($home);

        $response->assertNoContent();
    }
}
