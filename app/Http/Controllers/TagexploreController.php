<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Tagexplore;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TagexploreStoreRequest;
use App\Http\Requests\TagexploreUpdateRequest;

class TagexploreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Tagexplore::class);

        $search = $request->get('search', '');

        $tagexplores = Tagexplore::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.tagexplores.index', compact('tagexplores', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Tagexplore::class);

        return view('app.tagexplores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagexploreStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Tagexplore::class);

        $validated = $request->validated();

        $tagexplore = Tagexplore::create($validated);

        return redirect()
            ->route('tagexplores.edit', $tagexplore)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Tagexplore $tagexplore): View
    {
        $this->authorize('view', $tagexplore);

        return view('app.tagexplores.show', compact('tagexplore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Tagexplore $tagexplore): View
    {
        $this->authorize('update', $tagexplore);

        return view('app.tagexplores.edit', compact('tagexplore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TagexploreUpdateRequest $request,
        Tagexplore $tagexplore
    ): RedirectResponse {
        $this->authorize('update', $tagexplore);

        $validated = $request->validated();

        $tagexplore->update($validated);

        return redirect()
            ->route('tagexplores.edit', $tagexplore)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Tagexplore $tagexplore
    ): RedirectResponse {
        $this->authorize('delete', $tagexplore);

        $tagexplore->delete();

        return redirect()
            ->route('tagexplores.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
