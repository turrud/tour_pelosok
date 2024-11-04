<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Tagpackage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagpackageControllerTest extends TestCase
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
    public function it_displays_index_view_with_tagpackages(): void
    {
        $tagpackages = Tagpackage::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('tagpackages.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.tagpackages.index')
            ->assertViewHas('tagpackages');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_tagpackage(): void
    {
        $response = $this->get(route('tagpackages.create'));

        $response->assertOk()->assertViewIs('app.tagpackages.create');
    }

    /**
     * @test
     */
    public function it_stores_the_tagpackage(): void
    {
        $data = Tagpackage::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('tagpackages.store'), $data);

        $this->assertDatabaseHas('tagpackages', $data);

        $tagpackage = Tagpackage::latest('id')->first();

        $response->assertRedirect(route('tagpackages.edit', $tagpackage));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_tagpackage(): void
    {
        $tagpackage = Tagpackage::factory()->create();

        $response = $this->get(route('tagpackages.show', $tagpackage));

        $response
            ->assertOk()
            ->assertViewIs('app.tagpackages.show')
            ->assertViewHas('tagpackage');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_tagpackage(): void
    {
        $tagpackage = Tagpackage::factory()->create();

        $response = $this->get(route('tagpackages.edit', $tagpackage));

        $response
            ->assertOk()
            ->assertViewIs('app.tagpackages.edit')
            ->assertViewHas('tagpackage');
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

        $response = $this->put(route('tagpackages.update', $tagpackage), $data);

        $data['id'] = $tagpackage->id;

        $this->assertDatabaseHas('tagpackages', $data);

        $response->assertRedirect(route('tagpackages.edit', $tagpackage));
    }

    /**
     * @test
     */
    public function it_deletes_the_tagpackage(): void
    {
        $tagpackage = Tagpackage::factory()->create();

        $response = $this->delete(route('tagpackages.destroy', $tagpackage));

        $response->assertRedirect(route('tagpackages.index'));

        $this->assertSoftDeleted($tagpackage);
    }
}
