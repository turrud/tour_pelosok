<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Tagabout;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagaboutControllerTest extends TestCase
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
    public function it_displays_index_view_with_tagabouts(): void
    {
        $tagabouts = Tagabout::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('tagabouts.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.tagabouts.index')
            ->assertViewHas('tagabouts');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_tagabout(): void
    {
        $response = $this->get(route('tagabouts.create'));

        $response->assertOk()->assertViewIs('app.tagabouts.create');
    }

    /**
     * @test
     */
    public function it_stores_the_tagabout(): void
    {
        $data = Tagabout::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('tagabouts.store'), $data);

        $this->assertDatabaseHas('tagabouts', $data);

        $tagabout = Tagabout::latest('id')->first();

        $response->assertRedirect(route('tagabouts.edit', $tagabout));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_tagabout(): void
    {
        $tagabout = Tagabout::factory()->create();

        $response = $this->get(route('tagabouts.show', $tagabout));

        $response
            ->assertOk()
            ->assertViewIs('app.tagabouts.show')
            ->assertViewHas('tagabout');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_tagabout(): void
    {
        $tagabout = Tagabout::factory()->create();

        $response = $this->get(route('tagabouts.edit', $tagabout));

        $response
            ->assertOk()
            ->assertViewIs('app.tagabouts.edit')
            ->assertViewHas('tagabout');
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

        $response = $this->put(route('tagabouts.update', $tagabout), $data);

        $data['id'] = $tagabout->id;

        $this->assertDatabaseHas('tagabouts', $data);

        $response->assertRedirect(route('tagabouts.edit', $tagabout));
    }

    /**
     * @test
     */
    public function it_deletes_the_tagabout(): void
    {
        $tagabout = Tagabout::factory()->create();

        $response = $this->delete(route('tagabouts.destroy', $tagabout));

        $response->assertRedirect(route('tagabouts.index'));

        $this->assertSoftDeleted($tagabout);
    }
}
