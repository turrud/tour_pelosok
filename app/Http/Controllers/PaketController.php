<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PaketStoreRequest;
use App\Http\Requests\PaketUpdateRequest;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Paket::class);

        $search = $request->get('search', '');

        $pakets = Paket::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.pakets.index', compact('pakets', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Paket::class);

        return view('app.pakets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaketStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Paket::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $paket = Paket::create($validated);

        return redirect()
            ->route('pakets.edit', $paket)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Paket $paket): View
    {
        $this->authorize('view', $paket);

        return view('app.pakets.show', compact('paket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Paket $paket): View
    {
        $this->authorize('update', $paket);

        return view('app.pakets.edit', compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PaketUpdateRequest $request,
        Paket $paket
    ): RedirectResponse {
        $this->authorize('update', $paket);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($paket->image) {
                Storage::delete($paket->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $paket->update($validated);

        return redirect()
            ->route('pakets.edit', $paket)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Paket $paket): RedirectResponse
    {
        $this->authorize('delete', $paket);

        if ($paket->image) {
            Storage::delete($paket->image);
        }

        $paket->delete();

        return redirect()
            ->route('pakets.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
