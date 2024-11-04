<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Tagpackage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TagpackageStoreRequest;
use App\Http\Requests\TagpackageUpdateRequest;

class TagpackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Tagpackage::class);

        $search = $request->get('search', '');

        $tagpackages = Tagpackage::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.tagpackages.index', compact('tagpackages', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Tagpackage::class);

        return view('app.tagpackages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagpackageStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Tagpackage::class);

        $validated = $request->validated();

        $tagpackage = Tagpackage::create($validated);

        return redirect()
            ->route('tagpackages.edit', $tagpackage)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Tagpackage $tagpackage): View
    {
        $this->authorize('view', $tagpackage);

        return view('app.tagpackages.show', compact('tagpackage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Tagpackage $tagpackage): View
    {
        $this->authorize('update', $tagpackage);

        return view('app.tagpackages.edit', compact('tagpackage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TagpackageUpdateRequest $request,
        Tagpackage $tagpackage
    ): RedirectResponse {
        $this->authorize('update', $tagpackage);

        $validated = $request->validated();

        $tagpackage->update($validated);

        return redirect()
            ->route('tagpackages.edit', $tagpackage)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Tagpackage $tagpackage
    ): RedirectResponse {
        $this->authorize('delete', $tagpackage);

        $tagpackage->delete();

        return redirect()
            ->route('tagpackages.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
