<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Package;
use App\Models\Tagpackage;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PackageTagpackagesTest extends TestCase
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
    public function it_gets_package_tagpackages(): void
    {
        $package = Package::factory()->create();
        $tagpackage = Tagpackage::factory()->create();

        $package->tagpackages()->attach($tagpackage);

        $response = $this->getJson(
            route('api.packages.tagpackages.index', $package)
        );

        $response->assertOk()->assertSee($tagpackage->name);
    }

    /**
     * @test
     */
    public function it_can_attach_tagpackages_to_package(): void
    {
        $package = Package::factory()->create();
        $tagpackage = Tagpackage::factory()->create();

        $response = $this->postJson(
            route('api.packages.tagpackages.store', [$package, $tagpackage])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $package
                ->tagpackages()
                ->where('tagpackages.id', $tagpackage->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_tagpackages_from_package(): void
    {
        $package = Package::factory()->create();
        $tagpackage = Tagpackage::factory()->create();

        $response = $this->deleteJson(
            route('api.packages.tagpackages.store', [$package, $tagpackage])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $package
                ->tagpackages()
                ->where('tagpackages.id', $tagpackage->id)
                ->exists()
        );
    }
}
