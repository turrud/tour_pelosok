<?php

namespace App\Http\Controllers\Api;

use App\Models\Taghome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaghomeResource;
use App\Http\Resources\TaghomeCollection;
use App\Http\Requests\TaghomeStoreRequest;
use App\Http\Requests\TaghomeUpdateRequest;

class TaghomeController extends Controller
{
    public function index(Request $request): TaghomeCollection
    {
        $this->authorize('view-any', Taghome::class);

        $search = $request->get('search', '');

        $taghomes = Taghome::search($search)
            ->latest()
            ->paginate();

        return new TaghomeCollection($taghomes);
    }

    public function store(TaghomeStoreRequest $request): TaghomeResource
    {
        $this->authorize('create', Taghome::class);

        $validated = $request->validated();

        $taghome = Taghome::create($validated);

        return new TaghomeResource($taghome);
    }

    public function show(Request $request, Taghome $taghome): TaghomeResource
    {
        $this->authorize('view', $taghome);

        return new TaghomeResource($taghome);
    }

    public function update(
        TaghomeUpdateRequest $request,
        Taghome $taghome
    ): TaghomeResource {
        $this->authorize('update', $taghome);

        $validated = $request->validated();

        $taghome->update($validated);

        return new TaghomeResource($taghome);
    }

    public function destroy(Request $request, Taghome $taghome): Response
    {
        $this->authorize('delete', $taghome);

        $taghome->delete();

        return response()->noContent();
    }
}
