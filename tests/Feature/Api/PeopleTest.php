<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\People;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PeopleTest extends TestCase
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
    public function it_gets_all_people_list(): void
    {
        $allPeople = People::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-people.index'));

        $response->assertOk()->assertSee($allPeople[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_people(): void
    {
        $data = People::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-people.store'), $data);

        $this->assertDatabaseHas('people', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.all-people.update', $people),
            $data
        );

        $data['id'] = $people->id;

        $this->assertDatabaseHas('people', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_people(): void
    {
        $people = People::factory()->create();

        $response = $this->deleteJson(route('api.all-people.destroy', $people));

        $this->assertSoftDeleted($people);

        $response->assertNoContent();
    }
}
