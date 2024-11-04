<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Tagpackage;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagpackageTest extends TestCase
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
    public function it_gets_tagpackages_list(): void
    {
        $tagpackages = Tagpackage::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.tagpackages.index'));

        $response->assertOk()->assertSee($tagpackages[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_tagpackage(): void
    {
        $data = Tagpackage::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.tagpackages.store'), $data);

        $this->assertDatabaseHas('tagpackages', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_tagpackage(): void
    {
        $tagpackage = Tagpackage::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'slug' => $this->faker->unique->slug(),
        ];

        $response = $this->putJson(
            route('api.tagpackages.update', $tagpackage),
            $data
        );

        $data['id'] = $tagpackage->id;

        $this->assertDatabaseHas('tagpackages', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_tagpackage(): void
    {
        $tagpackage = Tagpackage::factory()->create();

        $response = $this->deleteJson(
            route('api.tagpackages.destroy', $tagpackage)
        );

        $this->assertSoftDeleted($tagpackage);

        $response->assertNoContent();
    }
}
