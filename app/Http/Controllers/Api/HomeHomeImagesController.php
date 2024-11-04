<?php

namespace App\Http\Controllers\Api;

use App\Models\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeImageResource;
use App\Http\Resources\HomeImageCollection;

class HomeHomeImagesController extends Controller
{
    public function index(Request $request, Home $home): HomeImageCollection
    {
        $this->authorize('view', $home);

        $search = $request->get('search', '');

        $homeImages = $home
            ->homeImages()
            ->search($search)
            ->latest()
            ->paginate();

        return new HomeImageCollection($homeImages);
    }

    public function store(Request $request, Home $home): HomeImageResource
    {
        $this->authorize('create', HomeImage::class);

        $validated = $request->validate([
            'order_number' => ['required', 'numeric'],
            'caption' => ['nullable', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $homeImage = $home->homeImages()->create($validated);

        return new HomeImageResource($homeImage);
    }
}
