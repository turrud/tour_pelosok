<?php
namespace App\Http\Controllers\Api;

use App\Models\About;
use App\Models\Tagabout;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagaboutCollection;

class AboutTagaboutsController extends Controller
{
    public function index(Request $request, About $about): TagaboutCollection
    {
        $this->authorize('view', $about);

        $search = $request->get('search', '');

        $tagabouts = $about
            ->tagabouts()
            ->search($search)
            ->latest()
            ->paginate();

        return new TagaboutCollection($tagabouts);
    }

    public function store(
        Request $request,
        About $about,
        Tagabout $tagabout
    ): Response {
        $this->authorize('update', $about);

        $about->tagabouts()->syncWithoutDetaching([$tagabout->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        About $about,
        Tagabout $tagabout
    ): Response {
        $this->authorize('update', $about);

        $about->tagabouts()->detach($tagabout);

        return response()->noContent();
    }
}
