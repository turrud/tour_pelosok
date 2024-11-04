<?php
namespace App\Http\Controllers\Api;

use App\Models\Explore;
use App\Models\Tagexplore;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagexploreCollection;

class ExploreTagexploresController extends Controller
{
    public function index(
        Request $request,
        Explore $explore
    ): TagexploreCollection {
        $this->authorize('view', $explore);

        $search = $request->get('search', '');

        $tagexplores = $explore
            ->tagexplores()
            ->search($search)
            ->latest()
            ->paginate();

        return new TagexploreCollection($tagexplores);
    }

    public function store(
        Request $request,
        Explore $explore,
        Tagexplore $tagexplore
    ): Response {
        $this->authorize('update', $explore);

        $explore->tagexplores()->syncWithoutDetaching([$tagexplore->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Explore $explore,
        Tagexplore $tagexplore
    ): Response {
        $this->authorize('update', $explore);

        $explore->tagexplores()->detach($tagexplore);

        return response()->noContent();
    }
}
