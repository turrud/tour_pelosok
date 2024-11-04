<?php

namespace App\Http\Controllers\Api;

use App\Models\Tagexplore;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagexploreResource;
use App\Http\Resources\TagexploreCollection;
use App\Http\Requests\TagexploreStoreRequest;
use App\Http\Requests\TagexploreUpdateRequest;

class TagexploreController extends Controller
{
    public function index(Request $request): TagexploreCollection
    {
        $this->authorize('view-any', Tagexplore::class);

        $search = $request->get('search', '');

        $tagexplores = Tagexplore::search($search)
            ->latest()
            ->paginate();

        return new TagexploreCollection($tagexplores);
    }

    public function store(TagexploreStoreRequest $request): TagexploreResource
    {
        $this->authorize('create', Tagexplore::class);

        $validated = $request->validated();

        $tagexplore = Tagexplore::create($validated);

        return new TagexploreResource($tagexplore);
    }

    public function show(
        Request $request,
        Tagexplore $tagexplore
    ): TagexploreResource {
        $this->authorize('view', $tagexplore);

        return new TagexploreResource($tagexplore);
    }

    public function update(
        TagexploreUpdateRequest $request,
        Tagexplore $tagexplore
    ): TagexploreResource {
        $this->authorize('update', $tagexplore);

        $validated = $request->validated();

        $tagexplore->update($validated);

        return new TagexploreResource($tagexplore);
    }

    public function destroy(Request $request, Tagexplore $tagexplore): Response
    {
        $this->authorize('delete', $tagexplore);

        $tagexplore->delete();

        return response()->noContent();
    }
}
