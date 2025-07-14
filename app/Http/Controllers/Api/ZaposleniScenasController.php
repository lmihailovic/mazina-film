<?php
namespace App\Http\Controllers\Api;

use App\Models\Scena;
use App\Models\Zaposleni;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScenaCollection;

class ZaposleniScenasController extends Controller
{
    public function index(
        Request $request,
        Zaposleni $zaposleni
    ): ScenaCollection {
        $this->authorize('view', $zaposleni);

        $search = $request->get('search', '');

        $scenas = $zaposleni
            ->scenas()
            ->search($search)
            ->latest()
            ->paginate();

        return new ScenaCollection($scenas);
    }

    public function store(
        Request $request,
        Zaposleni $zaposleni,
        Scena $scena
    ): Response {
        $this->authorize('update', $zaposleni);

        $zaposleni->scenas()->syncWithoutDetaching([$scena->ScenaId]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Zaposleni $zaposleni,
        Scena $scena
    ): Response {
        $this->authorize('update', $zaposleni);

        $zaposleni->scenas()->detach($scena);

        return response()->noContent();
    }
}
