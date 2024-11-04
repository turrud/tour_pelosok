<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Explore;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExploreControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_explores(): void
    {
        $explores = Explore::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('explores.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.explores.index')
            ->assertViewHas('explores');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_explore(): void
    {
        $response = $this->get(route('explores.create'));

        $response->assertOk()->assertViewIs('app.explores.create');
    }

    /**
     * @test
     */
    public function it_stores_the_explore(): void
    {
        $data = Explore::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('explores.store'), $data);

        $this->assertDatabaseHas('explores', $data);

        $explore = Explore::latest('id')->first();

        $response->assertRedirect(route('explores.edit', $explore));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_explore(): void
    {
        $explore = Explore::factory()->create();

        $response = $this->get(route('explores.show', $explore));

        $response
            ->assertOk()
            ->assertViewIs('app.explores.show')
            ->assertViewHas('explore');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_explore(): void
    {
        $explore = Explore::factory()->create();

        $response = $this->get(route('explores.edit', $explore));

        $response
            ->assertOk()
            ->assertViewIs('app.explores.edit')
            ->assertViewHas('explore');
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

        $response = $this->put(route('explores.update', $explore), $data);

        $data['id'] = $explore->id;

        $this->assertDatabaseHas('explores', $data);

        $response->assertRedirect(route('explores.edit', $explore));
    }

    /**
     * @test
     */
    public function it_deletes_the_explore(): void
    {
        $explore = Explore::factory()->create();

        $response = $this->delete(route('explores.destroy', $explore));

        $response->assertRedirect(route('explores.index'));

        $this->assertSoftDeleted($explore);
    }
}
