<?php
namespace App\Http\Controllers\Api;

use App\Models\Home;
use App\Models\Taghome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeCollection;

class TaghomeHomesController extends Controller
{
    public function index(Request $request, Taghome $taghome): HomeCollection
    {
        $this->authorize('view', $taghome);

        $search = $request->get('search', '');

        $homes = $taghome
            ->homes()
            ->search($search)
            ->latest()
            ->paginate();

        return new HomeCollection($homes);
    }

    public function store(
        Request $request,
        Taghome $taghome,
        Home $home
    ): Response {
        $this->authorize('update', $taghome);

        $taghome->homes()->syncWithoutDetaching([$home->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Taghome $taghome,
        Home $home
    ): Response {
        $this->authorize('update', $taghome);

        $taghome->homes()->detach($home);

        return response()->noContent();
    }
}
