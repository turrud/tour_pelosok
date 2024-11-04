<?php
namespace App\Http\Controllers\Api;

use App\Models\Explore;
use App\Models\Tagexplore;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExploreCollection;

class TagexploreExploresController extends Controller
{
    public function index(
        Request $request,
        Tagexplore $tagexplore
    ): ExploreCollection {
        $this->authorize('view', $tagexplore);

        $search = $request->get('search', '');

        $explores = $tagexplore
            ->explores()
            ->search($search)
            ->latest()
            ->paginate();

        return new ExploreCollection($explores);
    }

    public function store(
        Request $request,
        Tagexplore $tagexplore,
        Explore $explore
    ): Response {
        $this->authorize('update', $tagexplore);

        $tagexplore->explores()->syncWithoutDetaching([$explore->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Tagexplore $tagexplore,
        Explore $explore
    ): Response {
        $this->authorize('update', $tagexplore);

        $tagexplore->explores()->detach($explore);

        return response()->noContent();
    }
}
