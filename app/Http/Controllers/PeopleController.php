<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PeopleStoreRequest;
use App\Http\Requests\PeopleUpdateRequest;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', People::class);

        $search = $request->get('search', '');

        $allPeople = People::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_people.index', compact('allPeople', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', People::class);

        return view('app.all_people.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeopleStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', People::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $people = People::create($validated);

        return redirect()
            ->route('all-people.edit', $people)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, People $people): View
    {
        $this->authorize('view', $people);

        return view('app.all_people.show', compact('people'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, People $people): View
    {
        $this->authorize('update', $people);

        return view('app.all_people.edit', compact('people'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PeopleUpdateRequest $request,
        People $people
    ): RedirectResponse {
        $this->authorize('update', $people);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($people->image) {
                Storage::delete($people->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $people->update($validated);

        return redirect()
            ->route('all-people.edit', $people)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, People $people): RedirectResponse
    {
        $this->authorize('delete', $people);

        if ($people->image) {
            Storage::delete($people->image);
        }

        $people->delete();

        return redirect()
            ->route('all-people.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
