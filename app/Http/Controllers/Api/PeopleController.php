<?php

namespace App\Http\Controllers\Api;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PeopleResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PeopleCollection;
use App\Http\Requests\PeopleStoreRequest;
use App\Http\Requests\PeopleUpdateRequest;

class PeopleController extends Controller
{
    public function index(Request $request): PeopleCollection
    {
        $this->authorize('view-any', People::class);

        $search = $request->get('search', '');

        $allPeople = People::search($search)
            ->latest()
            ->paginate();

        return new PeopleCollection($allPeople);
    }

    public function store(PeopleStoreRequest $request): PeopleResource
    {
        $this->authorize('create', People::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $people = People::create($validated);

        return new PeopleResource($people);
    }

    public function show(Request $request, People $people): PeopleResource
    {
        $this->authorize('view', $people);

        return new PeopleResource($people);
    }

    public function update(
        PeopleUpdateRequest $request,
        People $people
    ): PeopleResource {
        $this->authorize('update', $people);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($people->image) {
                Storage::delete($people->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $people->update($validated);

        return new PeopleResource($people);
    }

    public function destroy(Request $request, People $people): Response
    {
        $this->authorize('delete', $people);

        if ($people->image) {
            Storage::delete($people->image);
        }

        $people->delete();

        return response()->noContent();
    }
}
