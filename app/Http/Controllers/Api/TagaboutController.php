<?php

namespace App\Http\Controllers\Api;

use App\Models\Tagabout;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagaboutResource;
use App\Http\Resources\TagaboutCollection;
use App\Http\Requests\TagaboutStoreRequest;
use App\Http\Requests\TagaboutUpdateRequest;

class TagaboutController extends Controller
{
    public function index(Request $request): TagaboutCollection
    {
        $this->authorize('view-any', Tagabout::class);

        $search = $request->get('search', '');

        $tagabouts = Tagabout::search($search)
            ->latest()
            ->paginate();

        return new TagaboutCollection($tagabouts);
    }

    public function store(TagaboutStoreRequest $request): TagaboutResource
    {
        $this->authorize('create', Tagabout::class);

        $validated = $request->validated();

        $tagabout = Tagabout::create($validated);

        return new TagaboutResource($tagabout);
    }

    public function show(Request $request, Tagabout $tagabout): TagaboutResource
    {
        $this->authorize('view', $tagabout);

        return new TagaboutResource($tagabout);
    }

    public function update(
        TagaboutUpdateRequest $request,
        Tagabout $tagabout
    ): TagaboutResource {
        $this->authorize('update', $tagabout);

        $validated = $request->validated();

        $tagabout->update($validated);

        return new TagaboutResource($tagabout);
    }

    public function destroy(Request $request, Tagabout $tagabout): Response
    {
        $this->authorize('delete', $tagabout);

        $tagabout->delete();

        return response()->noContent();
    }
}
