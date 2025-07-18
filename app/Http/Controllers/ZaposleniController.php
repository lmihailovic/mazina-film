<?php

namespace App\Http\Controllers;

use App\Models\Zaposleni;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ZaposleniStoreRequest;
use App\Http\Requests\ZaposleniUpdateRequest;

class ZaposleniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Zaposleni::class);

        $search = $request->get('search', '');

        $zaposlenis = Zaposleni::search($search)
            ->latest('ZaposleniId')
            ->paginate(5)
            ->withQueryString();

        return view('app.zaposlenis.index', compact('zaposlenis', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Zaposleni::class);

        return view('app.zaposlenis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ZaposleniStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Zaposleni::class);

        $validated = $request->validated();

        $zaposleni = Zaposleni::create($validated);

        return redirect()
            ->route('zaposlenis.edit', $zaposleni)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Zaposleni $zaposleni): View
    {
        $this->authorize('view', $zaposleni);

        $scenes = $zaposleni->scenas()
            ->with('film')
            ->orderBy('DatumSnimanja')
            ->get();


        return view('app.zaposlenis.show', compact('zaposleni', 'scenes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Zaposleni $zaposleni): View
    {
        $this->authorize('update', $zaposleni);

        return view('app.zaposlenis.edit', compact('zaposleni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ZaposleniUpdateRequest $request,
        Zaposleni $zaposleni
    ): RedirectResponse {
        $this->authorize('update', $zaposleni);

        $validated = $request->validated();

        $zaposleni->update($validated);

        return redirect()
            ->route('zaposlenis.edit', $zaposleni)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Zaposleni $zaposleni
    ): RedirectResponse {
        $this->authorize('delete', $zaposleni);

        // Start a database transaction
        DB::beginTransaction();
        try {
            if (auth()->user()->role === 'rukovodilac') {
                // For rukovodilac: set status to neaktivan and remove scene associations
                $zaposleni->scenas()->detach(); // Remove all scene associations
                $zaposleni->Status = 'neaktivan';
                $zaposleni->save();
            } else {
                // For admin: perform actual delete
                $zaposleni->delete();
            }

            DB::commit();
            return redirect()
                ->route('zaposlenis.index')
                ->withSuccess(__('crud.common.removed'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route('zaposlenis.index')
                ->withError('Greška tokom procesovanja zahteva.');
        }

    }
}
