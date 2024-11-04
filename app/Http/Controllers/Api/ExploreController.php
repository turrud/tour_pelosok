<?php

namespace App\Http\Controllers\Api;

use App\Models\Explore;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExploreResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ExploreCollection;
use App\Http\Requests\ExploreStoreRequest;
use App\Http\Requests\ExploreUpdateRequest;

class ExploreController extends Controller
{
    public function index(Request $request): ExploreCollection
    {
        $this->authorize('view-any', Explore::class);

        $search = $request->get('search', '');

        $explores = Explore::search($search)
            ->latest()
            ->paginate();

        return new ExploreCollection($explores);
    }

    public function store(ExploreStoreRequest $request): ExploreResource
    {
        $this->authorize('create', Explore::class);

        $validated = $request->validated();
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request
                ->file('main_image')
                ->store('public');
        }

        $explore = Explore::create($validated);

        return new ExploreResource($explore);
    }

    public function show(Request $request, Explore $explore): ExploreResource
    {
        $this->authorize('view', $explore);

        return new ExploreResource($explore);
    }

    public function update(
        ExploreUpdateRequest $request,
        Explore $explore
    ): ExploreResource {
        $this->authorize('update', $explore);

        $validated = $request->validated();

        if ($request->hasFile('main_image')) {
            if ($explore->main_image) {
                Storage::delete($explore->main_image);
            }

            $validated['main_image'] = $request
                ->file('main_image')
                ->store('public');
        }

        $explore->update($validated);

        return new ExploreResource($explore);
    }

    public function destroy(Request $request, Explore $explore): Response
    {
        $this->authorize('delete', $explore);

        if ($explore->main_image) {
            Storage::delete($explore->main_image);
        }

        $explore->delete();

        return response()->noContent();
    }
}
