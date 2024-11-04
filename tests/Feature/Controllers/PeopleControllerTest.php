<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\People;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PeopleControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_people(): void
    {
        $allPeople = People::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-people.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_people.index')
            ->assertViewHas('allPeople');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_people(): void
    {
        $response = $this->get(route('all-people.create'));

        $response->assertOk()->assertViewIs('app.all_people.create');
    }

    /**
     * @test
     */
    public function it_stores_the_people(): void
    {
        $data = People::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-people.store'), $data);

        $this->assertDatabaseHas('people', $data);

        $people = People::latest('id')->first();

        $response->assertRedirect(route('all-people.edit', $people));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_people(): void
    {
        $people = People::factory()->create();

        $response = $this->get(route('all-people.show', $people));

        $response
            ->assertOk()
            ->assertViewIs('app.all_people.show')
            ->assertViewHas('people');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_people(): void
    {
        $people = People::factory()->create();

        $response = $this->get(route('all-people.edit', $people));

        $response
            ->assertOk()
            ->assertViewIs('app.all_people.edit')
            ->assertViewHas('people');
    }

    /**
     * @test
     */
    public function it_updates_the_people(): void
    {
        $people = People::factory()->create();

        $data = [
            'order_number' => $this->faker->randomNumber(0),
            'name' => $this->faker->name(),
            'job_title' => $this->faker->sentence(10),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->put(route('all-people.update', $people), $data);

        $data['id'] = $people->id;

        $this->assertDatabaseHas('people', $data);

        $response->assertRedirect(route('all-people.edit', $people));
    }

    /**
     * @test
     */
    public function it_deletes_the_people(): void
    {
        $people = People::factory()->create();

        $response = $this->delete(route('all-people.destroy', $people));

        $response->assertRedirect(route('all-people.index'));

        $this->assertSoftDeleted($people);
    }
}
