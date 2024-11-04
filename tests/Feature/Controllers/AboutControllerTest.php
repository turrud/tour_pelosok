<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\About;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutControllerTest extends TestCase
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
    public function it_displays_index_view_with_abouts(): void
    {
        $abouts = About::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('abouts.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.abouts.index')
            ->assertViewHas('abouts');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_about(): void
    {
        $response = $this->get(route('abouts.create'));

        $response->assertOk()->assertViewIs('app.abouts.create');
    }

    /**
     * @test
     */
    public function it_stores_the_about(): void
    {
        $data = About::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('abouts.store'), $data);

        $this->assertDatabaseHas('abouts', $data);

        $about = About::latest('id')->first();

        $response->assertRedirect(route('abouts.edit', $about));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_about(): void
    {
        $about = About::factory()->create();

        $response = $this->get(route('abouts.show', $about));

        $response
            ->assertOk()
            ->assertViewIs('app.abouts.show')
            ->assertViewHas('about');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_about(): void
    {
        $about = About::factory()->create();

        $response = $this->get(route('abouts.edit', $about));

        $response
            ->assertOk()
            ->assertViewIs('app.abouts.edit')
            ->assertViewHas('about');
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

        $response = $this->put(route('abouts.update', $about), $data);

        $data['id'] = $about->id;

        $this->assertDatabaseHas('abouts', $data);

        $response->assertRedirect(route('abouts.edit', $about));
    }

    /**
     * @test
     */
    public function it_deletes_the_about(): void
    {
        $about = About::factory()->create();

        $response = $this->delete(route('abouts.destroy', $about));

        $response->assertRedirect(route('abouts.index'));

        $this->assertSoftDeleted($about);
    }
}
