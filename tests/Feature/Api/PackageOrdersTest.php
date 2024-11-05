<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Package;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PackageOrdersTest extends TestCase
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
    public function it_gets_package_orders(): void
    {
        $package = Package::factory()->create();
        $orders = Order::factory()
            ->count(2)
            ->create([
                'package_id' => $package->id,
            ]);

        $response = $this->getJson(
            route('api.packages.orders.index', $package)
        );

        $response->assertOk()->assertSee($orders[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_package_orders(): void
    {
        $package = Package::factory()->create();
        $data = Order::factory()
            ->make([
                'package_id' => $package->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.packages.orders.store', $package),
            $data
        );

        unset($data['package_id']);

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $order = Order::latest('id')->first();

        $this->assertEquals($package->id, $order->package_id);
    }
}
