<?php

namespace App\Http\Controllers\Api;

use App\Models\Explore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExploreImageResource;
use App\Http\Resources\ExploreImageCollection;

class ExploreExploreImagesController extends Controller
{
    public function index(
        Request $request,
        Explore $explore
    ): ExploreImageCollection {
        $this->authorize('view', $explore);

        $search = $request->get('search', '');

        $exploreImages = $explore
            ->exploreImages()
            ->search($search)
            ->latest()
            ->paginate();

        return new ExploreImageCollection($exploreImages);
    }

    public function store(
        Request $request,
        Explore $explore
    ): ExploreImageResource {
        $this->authorize('create', ExploreImage::class);

        $validated = $request->validate([
            'order_number' => ['required', 'numeric'],
            'caption' => ['nullable', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $exploreImage = $explore->exploreImages()->create($validated);

        return new ExploreImageResource($exploreImage);
    }
}
