<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Scena;
use App\Models\Zaposleni;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ScenaStoreRequest;
use App\Http\Requests\ScenaUpdateRequest;

class ScenaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Scena::class);

        $search = $request->get('search', '');

        $scenas = Scena::search($search)
            ->latest('ScenaId')
            ->paginate(5)
            ->withQueryString();

        return view('app.scenas.index', compact('scenas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Scena::class);

        $films = Film::pluck('Naziv', 'FilmId');

        return view('app.scenas.create', compact('films'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScenaStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Scena::class);

        $validated = $request->validated();

        $scena = Scena::create($validated);

        return redirect()
            ->route('scenas.edit', $scena)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Scena $scena): View
    {
        $this->authorize('view', $scena);

        return view('app.scenas.show', compact('scena'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Scena $scena): View
    {
        $this->authorize('update', $scena);

        $films = Film::pluck('Naziv', 'FilmId');
        $zaposleni = Zaposleni::all();

        return view('app.scenas.edit', compact('scena', 'films', 'zaposleni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScenaUpdateRequest $request, Scena $scena): RedirectResponse
    {
        $this->authorize('update', $scena);

        if ($request->has('action') && $request->has('zaposleni_id')) {
            if ($request->action === 'hire') {
                $scena->zaposlenis()->attach($request->zaposleni_id);
            } elseif ($request->action === 'release') {
                $scena->zaposlenis()->detach($request->zaposleni_id);
            }

            return redirect()
                ->route('scenas.edit', $scena)
                ->withSuccess(__('crud.common.saved'));
        }

        $validated = $request->validated();
        $scena->update($validated);

        return redirect()
            ->route('scenas.edit', $scena)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Scena $scena): RedirectResponse
    {
        $this->authorize('delete', $scena);

        $scena->delete();

        return redirect()
            ->route('scenas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
