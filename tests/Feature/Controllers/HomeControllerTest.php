<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Home;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
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
    public function it_displays_index_view_with_homes(): void
    {
        $homes = Home::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('homes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.homes.index')
            ->assertViewHas('homes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_home(): void
    {
        $response = $this->get(route('homes.create'));

        $response->assertOk()->assertViewIs('app.homes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_home(): void
    {
        $data = Home::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('homes.store'), $data);

        $this->assertDatabaseHas('homes', $data);

        $home = Home::latest('id')->first();

        $response->assertRedirect(route('homes.edit', $home));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_home(): void
    {
        $home = Home::factory()->create();

        $response = $this->get(route('homes.show', $home));

        $response
            ->assertOk()
            ->assertViewIs('app.homes.show')
            ->assertViewHas('home');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_home(): void
    {
        $home = Home::factory()->create();

        $response = $this->get(route('homes.edit', $home));

        $response
            ->assertOk()
            ->assertViewIs('app.homes.edit')
            ->assertViewHas('home');
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

        $response = $this->put(route('homes.update', $home), $data);

        $data['id'] = $home->id;

        $this->assertDatabaseHas('homes', $data);

        $response->assertRedirect(route('homes.edit', $home));
    }

    /**
     * @test
     */
    public function it_deletes_the_home(): void
    {
        $home = Home::factory()->create();

        $response = $this->delete(route('homes.destroy', $home));

        $response->assertRedirect(route('homes.index'));

        $this->assertSoftDeleted($home);
    }
}
