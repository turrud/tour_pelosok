<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Taghome;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaghomeTest extends TestCase
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
    public function it_gets_taghomes_list(): void
    {
        $taghomes = Taghome::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.taghomes.index'));

        $response->assertOk()->assertSee($taghomes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_taghome(): void
    {
        $data = Taghome::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.taghomes.store'), $data);

        $this->assertDatabaseHas('taghomes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_taghome(): void
    {
        $taghome = Taghome::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'slug' => $this->faker->unique->slug(),
        ];

        $response = $this->putJson(
            route('api.taghomes.update', $taghome),
            $data
        );

        $data['id'] = $taghome->id;

        $this->assertDatabaseHas('taghomes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_taghome(): void
    {
        $taghome = Taghome::factory()->create();

        $response = $this->deleteJson(route('api.taghomes.destroy', $taghome));

        $this->assertSoftDeleted($taghome);

        $response->assertNoContent();
    }
}
