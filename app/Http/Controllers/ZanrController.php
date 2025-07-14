<?php

namespace App\Http\Controllers;

use App\Models\Zanr;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ZanrStoreRequest;
use App\Http\Requests\ZanrUpdateRequest;

class ZanrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Zanr::class);

        $search = $request->get('search', '');

        $zanrs = Zanr::search($search)
            ->latest('ZanrId')
            ->paginate(5)
            ->withQueryString();

        return view('app.zanrs.index', compact('zanrs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Zanr::class);

        return view('app.zanrs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ZanrStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Zanr::class);

        $validated = $request->validated();

        $zanr = Zanr::create($validated);

        return redirect()
            ->route('zanrs.edit', $zanr)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Zanr $zanr): View
    {
        $this->authorize('view', $zanr);

        return view('app.zanrs.show', compact('zanr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Zanr $zanr): View
    {
        $this->authorize('update', $zanr);

        return view('app.zanrs.edit', compact('zanr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ZanrUpdateRequest $request,
        Zanr $zanr
    ): RedirectResponse {
        $this->authorize('update', $zanr);

        $validated = $request->validated();

        $zanr->update($validated);

        return redirect()
            ->route('zanrs.edit', $zanr)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Zanr $zanr): RedirectResponse
    {
        $this->authorize('delete', $zanr);

        $zanr->delete();

        return redirect()
            ->route('zanrs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
