<?php

namespace App\Http\Controllers;

use App\Models\Taghome;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TaghomeStoreRequest;
use App\Http\Requests\TaghomeUpdateRequest;

class TaghomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Taghome::class);

        $search = $request->get('search', '');

        $taghomes = Taghome::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.taghomes.index', compact('taghomes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Taghome::class);

        return view('app.taghomes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaghomeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Taghome::class);

        $validated = $request->validated();

        $taghome = Taghome::create($validated);

        return redirect()
            ->route('taghomes.edit', $taghome)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Taghome $taghome): View
    {
        $this->authorize('view', $taghome);

        return view('app.taghomes.show', compact('taghome'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Taghome $taghome): View
    {
        $this->authorize('update', $taghome);

        return view('app.taghomes.edit', compact('taghome'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TaghomeUpdateRequest $request,
        Taghome $taghome
    ): RedirectResponse {
        $this->authorize('update', $taghome);

        $validated = $request->validated();

        $taghome->update($validated);

        return redirect()
            ->route('taghomes.edit', $taghome)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Taghome $taghome
    ): RedirectResponse {
        $this->authorize('delete', $taghome);

        $taghome->delete();

        return redirect()
            ->route('taghomes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
