<?php

namespace App\Http\Controllers\Api;

use App\Models\Tagpackage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagpackageResource;
use App\Http\Resources\TagpackageCollection;
use App\Http\Requests\TagpackageStoreRequest;
use App\Http\Requests\TagpackageUpdateRequest;

class TagpackageController extends Controller
{
    public function index(Request $request): TagpackageCollection
    {
        $this->authorize('view-any', Tagpackage::class);

        $search = $request->get('search', '');

        $tagpackages = Tagpackage::search($search)
            ->latest()
            ->paginate();

        return new TagpackageCollection($tagpackages);
    }

    public function store(TagpackageStoreRequest $request): TagpackageResource
    {
        $this->authorize('create', Tagpackage::class);

        $validated = $request->validated();

        $tagpackage = Tagpackage::create($validated);

        return new TagpackageResource($tagpackage);
    }

    public function show(
        Request $request,
        Tagpackage $tagpackage
    ): TagpackageResource {
        $this->authorize('view', $tagpackage);

        return new TagpackageResource($tagpackage);
    }

    public function update(
        TagpackageUpdateRequest $request,
        Tagpackage $tagpackage
    ): TagpackageResource {
        $this->authorize('update', $tagpackage);

        $validated = $request->validated();

        $tagpackage->update($validated);

        return new TagpackageResource($tagpackage);
    }

    public function destroy(Request $request, Tagpackage $tagpackage): Response
    {
        $this->authorize('delete', $tagpackage);

        $tagpackage->delete();

        return response()->noContent();
    }
}
