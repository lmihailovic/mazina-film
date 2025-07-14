<?php

namespace App\Http\Controllers\Api;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\FilmResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\FilmCollection;
use App\Http\Requests\FilmStoreRequest;
use App\Http\Requests\FilmUpdateRequest;

class FilmController extends Controller
{
    public function index(Request $request): FilmCollection
    {
        $this->authorize('view-any', Film::class);

        $search = $request->get('search', '');

        $films = Film::search($search)
            ->latest('FilmId')
            ->paginate();

        return new FilmCollection($films);
    }

    public function store(FilmStoreRequest $request): FilmResource
    {
        $this->authorize('create', Film::class);

        $validated = $request->validated();

        $film = Film::create($validated);

        return new FilmResource($film);
    }

    public function show(Request $request, Film $film): FilmResource
    {
        $this->authorize('view', $film);

        return new FilmResource($film);
    }

    public function update(FilmUpdateRequest $request, Film $film): FilmResource
    {
        $this->authorize('update', $film);

        $validated = $request->validated();

        $film->update($validated);

        return new FilmResource($film);
    }

    public function destroy(Request $request, Film $film): Response
    {
        $this->authorize('delete', $film);

        $film->delete();

        return response()->noContent();
    }
}
