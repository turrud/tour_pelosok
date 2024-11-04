<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Package;
use App\Models\Tagpackage;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagpackagePackagesTest extends TestCase
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
    public function it_gets_tagpackage_packages(): void
    {
        $tagpackage = Tagpackage::factory()->create();
        $package = Package::factory()->create();

        $tagpackage->packages()->attach($package);

        $response = $this->getJson(
            route('api.tagpackages.packages.index', $tagpackage)
        );

        $response->assertOk()->assertSee($package->title);
    }

    /**
     * @test
     */
    public function it_can_attach_packages_to_tagpackage(): void
    {
        $tagpackage = Tagpackage::factory()->create();
        $package = Package::factory()->create();

        $response = $this->postJson(
            route('api.tagpackages.packages.store', [$tagpackage, $package])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $tagpackage
                ->packages()
                ->where('packages.id', $package->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_packages_from_tagpackage(): void
    {
        $tagpackage = Tagpackage::factory()->create();
        $package = Package::factory()->create();

        $response = $this->deleteJson(
            route('api.tagpackages.packages.store', [$tagpackage, $package])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $tagpackage
                ->packages()
                ->where('packages.id', $package->id)
                ->exists()
        );
    }
}
