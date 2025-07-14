<?php

namespace App\Http\Controllers\Api;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScenaResource;
use App\Http\Resources\ScenaCollection;

class FilmScenasController extends Controller
{
    public function index(Request $request, Film $film): ScenaCollection
    {
        $this->authorize('view', $film);

        $search = $request->get('search', '');

        $scenas = $film
            ->scenas()
            ->search($search)
            ->latest()
            ->paginate();

        return new ScenaCollection($scenas);
    }

    public function store(Request $request, Film $film): ScenaResource
    {
        $this->authorize('create', Scena::class);

        $validated = $request->validate([
            'Lokacija' => ['required', 'max:255', 'string'],
            'DatumSnimanja' => ['nullable', 'date'],
        ]);

        $scena = $film->scenas()->create($validated);

        return new ScenaResource($scena);
    }
}
