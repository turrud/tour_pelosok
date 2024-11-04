<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Tagexplore;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagexploreControllerTest extends TestCase
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
    public function it_displays_index_view_with_tagexplores(): void
    {
        $tagexplores = Tagexplore::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('tagexplores.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.tagexplores.index')
            ->assertViewHas('tagexplores');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_tagexplore(): void
    {
        $response = $this->get(route('tagexplores.create'));

        $response->assertOk()->assertViewIs('app.tagexplores.create');
    }

    /**
     * @test
     */
    public function it_stores_the_tagexplore(): void
    {
        $data = Tagexplore::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('tagexplores.store'), $data);

        $this->assertDatabaseHas('tagexplores', $data);

        $tagexplore = Tagexplore::latest('id')->first();

        $response->assertRedirect(route('tagexplores.edit', $tagexplore));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_tagexplore(): void
    {
        $tagexplore = Tagexplore::factory()->create();

        $response = $this->get(route('tagexplores.show', $tagexplore));

        $response
            ->assertOk()
            ->assertViewIs('app.tagexplores.show')
            ->assertViewHas('tagexplore');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_tagexplore(): void
    {
        $tagexplore = Tagexplore::factory()->create();

        $response = $this->get(route('tagexplores.edit', $tagexplore));

        $response
            ->assertOk()
            ->assertViewIs('app.tagexplores.edit')
            ->assertViewHas('tagexplore');
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

        $response = $this->put(route('tagexplores.update', $tagexplore), $data);

        $data['id'] = $tagexplore->id;

        $this->assertDatabaseHas('tagexplores', $data);

        $response->assertRedirect(route('tagexplores.edit', $tagexplore));
    }

    /**
     * @test
     */
    public function it_deletes_the_tagexplore(): void
    {
        $tagexplore = Tagexplore::factory()->create();

        $response = $this->delete(route('tagexplores.destroy', $tagexplore));

        $response->assertRedirect(route('tagexplores.index'));

        $this->assertSoftDeleted($tagexplore);
    }
}
