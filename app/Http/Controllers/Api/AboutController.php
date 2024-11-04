<?php

namespace App\Http\Controllers\Api;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Http\Resources\AboutCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AboutStoreRequest;
use App\Http\Requests\AboutUpdateRequest;

class AboutController extends Controller
{
    public function index(Request $request): AboutCollection
    {
        $this->authorize('view-any', About::class);

        $search = $request->get('search', '');

        $abouts = About::search($search)
            ->latest()
            ->paginate();

        return new AboutCollection($abouts);
    }

    public function store(AboutStoreRequest $request): AboutResource
    {
        $this->authorize('create', About::class);

        $validated = $request->validated();
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request
                ->file('main_image')
                ->store('public');
        }

        $about = About::create($validated);

        return new AboutResource($about);
    }

    public function show(Request $request, About $about): AboutResource
    {
        $this->authorize('view', $about);

        return new AboutResource($about);
    }

    public function update(
        AboutUpdateRequest $request,
        About $about
    ): AboutResource {
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

        return new AboutResource($about);
    }

    public function destroy(Request $request, About $about): Response
    {
        $this->authorize('delete', $about);

        if ($about->main_image) {
            Storage::delete($about->main_image);
        }

        $about->delete();

        return response()->noContent();
    }
}
