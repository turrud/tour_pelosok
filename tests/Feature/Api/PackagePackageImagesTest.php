<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Package;
use App\Models\PackageImage;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PackagePackageImagesTest extends TestCase
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
    public function it_gets_package_package_images(): void
    {
        $package = Package::factory()->create();
        $packageImages = PackageImage::factory()
            ->count(2)
            ->create([
                'package_id' => $package->id,
            ]);

        $response = $this->getJson(
            route('api.packages.package-images.index', $package)
        );

        $response->assertOk()->assertSee($packageImages[0]->caption);
    }

    /**
     * @test
     */
    public function it_stores_the_package_package_images(): void
    {
        $package = Package::factory()->create();
        $data = PackageImage::factory()
            ->make([
                'package_id' => $package->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.packages.package-images.store', $package),
            $data
        );

        unset($data['package_id']);

        $this->assertDatabaseHas('package_images', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $packageImage = PackageImage::latest('id')->first();

        $this->assertEquals($package->id, $packageImage->package_id);
    }
}
