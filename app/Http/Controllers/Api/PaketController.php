<?php

namespace App\Http\Controllers\Api;

use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaketResource;
use App\Http\Resources\PaketCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PaketStoreRequest;
use App\Http\Requests\PaketUpdateRequest;

class PaketController extends Controller
{
    public function index(Request $request): PaketCollection
    {
        $this->authorize('view-any', Paket::class);

        $search = $request->get('search', '');

        $pakets = Paket::search($search)
            ->latest()
            ->paginate();

        return new PaketCollection($pakets);
    }

    public function store(PaketStoreRequest $request): PaketResource
    {
        $this->authorize('create', Paket::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $paket = Paket::create($validated);

        return new PaketResource($paket);
    }

    public function show(Request $request, Paket $paket): PaketResource
    {
        $this->authorize('view', $paket);

        return new PaketResource($paket);
    }

    public function update(
        PaketUpdateRequest $request,
        Paket $paket
    ): PaketResource {
        $this->authorize('update', $paket);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($paket->image) {
                Storage::delete($paket->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $paket->update($validated);

        return new PaketResource($paket);
    }

    public function destroy(Request $request, Paket $paket): Response
    {
        $this->authorize('delete', $paket);

        if ($paket->image) {
            Storage::delete($paket->image);
        }

        $paket->delete();

        return response()->noContent();
    }
}
