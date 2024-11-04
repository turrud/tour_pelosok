<?php
namespace App\Http\Controllers\Api;

use App\Models\Home;
use App\Models\Taghome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaghomeCollection;

class HomeTaghomesController extends Controller
{
    public function index(Request $request, Home $home): TaghomeCollection
    {
        $this->authorize('view', $home);

        $search = $request->get('search', '');

        $taghomes = $home
            ->taghomes()
            ->search($search)
            ->latest()
            ->paginate();

        return new TaghomeCollection($taghomes);
    }

    public function store(
        Request $request,
        Home $home,
        Taghome $taghome
    ): Response {
        $this->authorize('update', $home);

        $home->taghomes()->syncWithoutDetaching([$taghome->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Home $home,
        Taghome $taghome
    ): Response {
        $this->authorize('update', $home);

        $home->taghomes()->detach($taghome);

        return response()->noContent();
    }
}
