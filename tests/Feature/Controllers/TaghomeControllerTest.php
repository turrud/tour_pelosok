<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Taghome;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaghomeControllerTest extends TestCase
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
    public function it_displays_index_view_with_taghomes(): void
    {
        $taghomes = Taghome::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('taghomes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.taghomes.index')
            ->assertViewHas('taghomes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_taghome(): void
    {
        $response = $this->get(route('taghomes.create'));

        $response->assertOk()->assertViewIs('app.taghomes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_taghome(): void
    {
        $data = Taghome::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('taghomes.store'), $data);

        $this->assertDatabaseHas('taghomes', $data);

        $taghome = Taghome::latest('id')->first();

        $response->assertRedirect(route('taghomes.edit', $taghome));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_taghome(): void
    {
        $taghome = Taghome::factory()->create();

        $response = $this->get(route('taghomes.show', $taghome));

        $response
            ->assertOk()
            ->assertViewIs('app.taghomes.show')
            ->assertViewHas('taghome');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_taghome(): void
    {
        $taghome = Taghome::factory()->create();

        $response = $this->get(route('taghomes.edit', $taghome));

        $response
            ->assertOk()
            ->assertViewIs('app.taghomes.edit')
            ->assertViewHas('taghome');
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

        $response = $this->put(route('taghomes.update', $taghome), $data);

        $data['id'] = $taghome->id;

        $this->assertDatabaseHas('taghomes', $data);

        $response->assertRedirect(route('taghomes.edit', $taghome));
    }

    /**
     * @test
     */
    public function it_deletes_the_taghome(): void
    {
        $taghome = Taghome::factory()->create();

        $response = $this->delete(route('taghomes.destroy', $taghome));

        $response->assertRedirect(route('taghomes.index'));

        $this->assertSoftDeleted($taghome);
    }
}
