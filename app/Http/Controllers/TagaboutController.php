<?php

namespace App\Http\Controllers;

use App\Models\Tagabout;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TagaboutStoreRequest;
use App\Http\Requests\TagaboutUpdateRequest;

class TagaboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Tagabout::class);

        $search = $request->get('search', '');

        $tagabouts = Tagabout::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.tagabouts.index', compact('tagabouts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Tagabout::class);

        return view('app.tagabouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagaboutStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Tagabout::class);

        $validated = $request->validated();

        $tagabout = Tagabout::create($validated);

        return redirect()
            ->route('tagabouts.edit', $tagabout)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Tagabout $tagabout): View
    {
        $this->authorize('view', $tagabout);

        return view('app.tagabouts.show', compact('tagabout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Tagabout $tagabout): View
    {
        $this->authorize('update', $tagabout);

        return view('app.tagabouts.edit', compact('tagabout'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TagaboutUpdateRequest $request,
        Tagabout $tagabout
    ): RedirectResponse {
        $this->authorize('update', $tagabout);

        $validated = $request->validated();

        $tagabout->update($validated);

        return redirect()
            ->route('tagabouts.edit', $tagabout)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Tagabout $tagabout
    ): RedirectResponse {
        $this->authorize('delete', $tagabout);

        $tagabout->delete();

        return redirect()
            ->route('tagabouts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
