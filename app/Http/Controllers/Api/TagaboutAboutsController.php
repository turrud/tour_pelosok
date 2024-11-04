<?php
namespace App\Http\Controllers\Api;

use App\Models\About;
use App\Models\Tagabout;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutCollection;

class TagaboutAboutsController extends Controller
{
    public function index(Request $request, Tagabout $tagabout): AboutCollection
    {
        $this->authorize('view', $tagabout);

        $search = $request->get('search', '');

        $abouts = $tagabout
            ->abouts()
            ->search($search)
            ->latest()
            ->paginate();

        return new AboutCollection($abouts);
    }

    public function store(
        Request $request,
        Tagabout $tagabout,
        About $about
    ): Response {
        $this->authorize('update', $tagabout);

        $tagabout->abouts()->syncWithoutDetaching([$about->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Tagabout $tagabout,
        About $about
    ): Response {
        $this->authorize('update', $tagabout);

        $tagabout->abouts()->detach($about);

        return response()->noContent();
    }
}
