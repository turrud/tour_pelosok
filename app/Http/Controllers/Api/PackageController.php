<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PackageCollection;
use App\Http\Requests\PackageStoreRequest;
use App\Http\Requests\PackageUpdateRequest;

class PackageController extends Controller
{
    public function index(Request $request): PackageCollection
    {
        $this->authorize('view-any', Package::class);

        $search = $request->get('search', '');

        $packages = Package::search($search)
            ->latest()
            ->paginate();

        return new PackageCollection($packages);
    }

    public function store(PackageStoreRequest $request): PackageResource
    {
        $this->authorize('create', Package::class);

        $validated = $request->validated();
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request
                ->file('main_image')
                ->store('public');
        }

        $package = Package::create($validated);

        return new PackageResource($package);
    }

    public function show(Request $request, Package $package): PackageResource
    {
        $this->authorize('view', $package);

        return new PackageResource($package);
    }

    public function update(
        PackageUpdateRequest $request,
        Package $package
    ): PackageResource {
        $this->authorize('update', $package);

        $validated = $request->validated();

        if ($request->hasFile('main_image')) {
            if ($package->main_image) {
                Storage::delete($package->main_image);
            }

            $validated['main_image'] = $request
                ->file('main_image')
                ->store('public');
        }

        $package->update($validated);

        return new PackageResource($package);
    }

    public function destroy(Request $request, Package $package): Response
    {
        $this->authorize('delete', $package);

        if ($package->main_image) {
            Storage::delete($package->main_image);
        }

        $package->delete();

        return response()->noContent();
    }
}
