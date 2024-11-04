<?php
namespace App\Http\Controllers\Api;

use App\Models\Package;
use App\Models\Tagpackage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PackageCollection;

class TagpackagePackagesController extends Controller
{
    public function index(
        Request $request,
        Tagpackage $tagpackage
    ): PackageCollection {
        $this->authorize('view', $tagpackage);

        $search = $request->get('search', '');

        $packages = $tagpackage
            ->packages()
            ->search($search)
            ->latest()
            ->paginate();

        return new PackageCollection($packages);
    }

    public function store(
        Request $request,
        Tagpackage $tagpackage,
        Package $package
    ): Response {
        $this->authorize('update', $tagpackage);

        $tagpackage->packages()->syncWithoutDetaching([$package->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Tagpackage $tagpackage,
        Package $package
    ): Response {
        $this->authorize('update', $tagpackage);

        $tagpackage->packages()->detach($package);

        return response()->noContent();
    }
}
