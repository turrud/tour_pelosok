<?php

namespace App\Http\Controllers;

use App\Models\Explore;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ExploreStoreRequest;
use App\Http\Requests\ExploreUpdateRequest;

class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Explore::class);

        $search = $request->get('search', '');

        $explores = Explore::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.explores.index', compact('explores', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Explore::class);

        return view('app.explores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExploreStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Explore::class);

        $validated = $request->validated();
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request
                ->file('main_image')
                ->store('public');
        }

        $explore = Explore::create($validated);

        return redirect()
            ->route('explores.edit', $explore)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Explore $explore): View
    {
        $this->authorize('view', $explore);

        return view('app.explores.show', compact('explore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Explore $explore): View
    {
        $this->authorize('update', $explore);

        return view('app.explores.edit', compact('explore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ExploreUpdateRequest $request,
        Explore $explore
    ): RedirectResponse {
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

        return redirect()
            ->route('explores.edit', $explore)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Explore $explore
    ): RedirectResponse {
        $this->authorize('delete', $explore);

        if ($explore->main_image) {
            Storage::delete($explore->main_image);
        }

        $explore->delete();

        return redirect()
            ->route('explores.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
