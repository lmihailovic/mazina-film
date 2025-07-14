<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Zanr;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FilmStoreRequest;
use App\Http\Requests\FilmUpdateRequest;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Film::class);

        $search = $request->get('search', '');

        $films = Film::search($search)
            ->latest('FilmId')
            ->paginate(5)
            ->withQueryString();

        return view('app.films.index', compact('films', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Film::class);

        $zanrs = Zanr::pluck('Naziv', 'ZanrId');

        return view('app.films.create', compact('zanrs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Film::class);

        $validated = $request->validated();

        $film = Film::create($validated);

        return redirect()
            ->route('films.edit', $film)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Film $film): View
    {
        $this->authorize('view', $film);

        return view('app.films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Film $film): View
    {
        $this->authorize('update', $film);

        $zanrs = Zanr::pluck('Naziv', 'ZanrId');

        return view('app.films.edit', compact('film', 'zanrs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        FilmUpdateRequest $request,
        Film $film
    ): RedirectResponse {
        $this->authorize('update', $film);

        $validated = $request->validated();

        $film->update($validated);

        return redirect()
            ->route('films.edit', $film)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Film $film): RedirectResponse
    {
        $this->authorize('delete', $film);

        $film->delete();

        return redirect()
            ->route('films.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
