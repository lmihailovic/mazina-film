<?php
namespace App\Http\Controllers\Api;

use App\Models\Scena;
use App\Models\Zaposleni;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ZaposleniCollection;

class ScenaZaposlenisController extends Controller
{
    public function index(Request $request, Scena $scena): ZaposleniCollection
    {
        $this->authorize('view', $scena);

        $search = $request->get('search', '');

        $zaposlenis = $scena
            ->zaposlenis()
            ->search($search)
            ->latest()
            ->paginate();

        return new ZaposleniCollection($zaposlenis);
    }

    public function store(
        Request $request,
        Scena $scena,
        Zaposleni $zaposleni
    ): Response {
        $this->authorize('update', $scena);

        $scena->zaposlenis()->syncWithoutDetaching([$zaposleni->ZaposleniId]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Scena $scena,
        Zaposleni $zaposleni
    ): Response {
        $this->authorize('update', $scena);

        $scena->zaposlenis()->detach($zaposleni);

        return response()->noContent();
    }
}
