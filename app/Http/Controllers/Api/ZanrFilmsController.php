<?php

namespace App\Http\Controllers\Api;

use App\Models\Zanr;
use Illuminate\Http\Request;
use App\Http\Resources\FilmResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\FilmCollection;

class ZanrFilmsController extends Controller
{
    public function index(Request $request, Zanr $zanr): FilmCollection
    {
        $this->authorize('view', $zanr);

        $search = $request->get('search', '');

        $films = $zanr
            ->films()
            ->search($search)
            ->latest()
            ->paginate();

        return new FilmCollection($films);
    }

    public function store(Request $request, Zanr $zanr): FilmResource
    {
        $this->authorize('create', Film::class);

        $validated = $request->validate([
            'Naziv' => ['required', 'max:100', 'string'],
            'Status' => ['required', 'max:100', 'string'],
            'Budzet' => [
                'nullable',
                'in:predprodukcija,produkcija,postprodukcija,pauza,planiranje,distribucija,arhiviran',
            ],
            'DatumIzlaska' => ['nullable', 'date'],
        ]);

        $film = $zanr->films()->create($validated);

        return new FilmResource($film);
    }
}
