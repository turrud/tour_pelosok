<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AboutStoreRequest;
use App\Http\Requests\AboutUpdateRequest;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', About::class);

        $search = $request->get('search', '');

        $abouts = About::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.abouts.index', compact('abouts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', About::class);

        return view('app.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', About::class);

        $validated = $request->validated();
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request
                ->file('main_image')
                ->store('public');
        }

        $about = About::create($validated);

        return redirect()
            ->route('abouts.edit', $about)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, About $about): View
    {
        $this->authorize('view', $about);

        return view('app.abouts.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, About $about): View
    {
        $this->authorize('update', $about);

        return view('app.abouts.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AboutUpdateRequest $request,
        About $about
    ): RedirectResponse {
        $this->authorize('update', $about);

        $validated = $request->validated();
        if ($request->hasFile('main_image')) {
            if ($about->main_image) {
                Storage::delete($about->main_image);
            }

            $validated['main_image'] = $request
                ->file('main_image')
                ->store('public');
        }

        $about->update($validated);

        return redirect()
            ->route('abouts.edit', $about)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, About $about): RedirectResponse
    {
        $this->authorize('delete', $about);

        if ($about->main_image) {
            Storage::delete($about->main_image);
        }

        $about->delete();

        return redirect()
            ->route('abouts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
