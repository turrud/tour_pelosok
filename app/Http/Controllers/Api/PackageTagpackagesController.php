<?php
namespace App\Http\Controllers\Api;

use App\Models\Package;
use App\Models\Tagpackage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagpackageCollection;

class PackageTagpackagesController extends Controller
{
    public function index(
        Request $request,
        Package $package
    ): TagpackageCollection {
        $this->authorize('view', $package);

        $search = $request->get('search', '');

        $tagpackages = $package
            ->tagpackages()
            ->search($search)
            ->latest()
            ->paginate();

        return new TagpackageCollection($tagpackages);
    }

    public function store(
        Request $request,
        Package $package,
        Tagpackage $tagpackage
    ): Response {
        $this->authorize('update', $package);

        $package->tagpackages()->syncWithoutDetaching([$tagpackage->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Package $package,
        Tagpackage $tagpackage
    ): Response {
        $this->authorize('update', $package);

        $package->tagpackages()->detach($tagpackage);

        return response()->noContent();
    }
}
