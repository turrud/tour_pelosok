<?php

namespace App\Http\Controllers\Api;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutImageResource;
use App\Http\Resources\AboutImageCollection;

class AboutAboutImagesController extends Controller
{
    public function index(Request $request, About $about): AboutImageCollection
    {
        $this->authorize('view', $about);

        $search = $request->get('search', '');

        $aboutImages = $about
            ->aboutImages()
            ->search($search)
            ->latest()
            ->paginate();

        return new AboutImageCollection($aboutImages);
    }

    public function store(Request $request, About $about): AboutImageResource
    {
        $this->authorize('create', AboutImage::class);

        $validated = $request->validate([
            'order_number' => ['required', 'numeric'],
            'caption' => ['nullable', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $aboutImage = $about->aboutImages()->create($validated);

        return new AboutImageResource($aboutImage);
    }
}
