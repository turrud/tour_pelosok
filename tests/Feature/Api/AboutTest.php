<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\About;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutTest extends TestCase
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
    public function it_gets_abouts_list(): void
    {
        $abouts = About::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.abouts.index'));

        $response->assertOk()->assertSee($abouts[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_about(): void
    {
        $data = About::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.abouts.store'), $data);

        $this->assertDatabaseHas('abouts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_about(): void
    {
        $about = About::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->putJson(route('api.abouts.update', $about), $data);

        $data['id'] = $about->id;

        $this->assertDatabaseHas('abouts', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_about(): void
    {
        $about = About::factory()->create();

        $response = $this->deleteJson(route('api.abouts.destroy', $about));

        $this->assertSoftDeleted($about);

        $response->assertNoContent();
    }
}
