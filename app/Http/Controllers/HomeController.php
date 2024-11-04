<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\HomeStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HomeUpdateRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Home::class);

        $search = $request->get('search', '');

        $homes = Home::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.homes.index', compact('homes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Home::class);

        return view('app.homes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HomeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Home::class);

        $validated = $request->validated();
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request
                ->file('main_image')
                ->store('public');
        }

        $home = Home::create($validated);

        return redirect()
            ->route('homes.edit', $home)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Home $home): View
    {
        $this->authorize('view', $home);

        return view('app.homes.show', compact('home'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Home $home): View
    {
        $this->authorize('update', $home);

        return view('app.homes.edit', compact('home'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        HomeUpdateRequest $request,
        Home $home
    ): RedirectResponse {
        $this->authorize('update', $home);

        $validated = $request->validated();
        if ($request->hasFile('main_image')) {
            if ($home->main_image) {
                Storage::delete($home->main_image);
            }

            $validated['main_image'] = $request
                ->file('main_image')
                ->store('public');
        }

        $home->update($validated);

        return redirect()
            ->route('homes.edit', $home)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Home $home): RedirectResponse
    {
        $this->authorize('delete', $home);

        if ($home->main_image) {
            Storage::delete($home->main_image);
        }

        $home->delete();

        return redirect()
            ->route('homes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
