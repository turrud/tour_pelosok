<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PackageImageResource;
use App\Http\Resources\PackageImageCollection;

class PackagePackageImagesController extends Controller
{
    public function index(
        Request $request,
        Package $package
    ): PackageImageCollection {
        $this->authorize('view', $package);

        $search = $request->get('search', '');

        $packageImages = $package
            ->packageImages()
            ->search($search)
            ->latest()
            ->paginate();

        return new PackageImageCollection($packageImages);
    }

    public function store(
        Request $request,
        Package $package
    ): PackageImageResource {
        $this->authorize('create', PackageImage::class);

        $validated = $request->validate([
            'order_number' => ['required', 'numeric'],
            'caption' => ['nullable', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $packageImage = $package->packageImages()->create($validated);

        return new PackageImageResource($packageImage);
    }
}
