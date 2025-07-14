<?php

namespace App\Http\Controllers\Api;

use App\Models\Zaposleni;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ZaposleniResource;
use App\Http\Resources\ZaposleniCollection;
use App\Http\Requests\ZaposleniStoreRequest;
use App\Http\Requests\ZaposleniUpdateRequest;

class ZaposleniController extends Controller
{
    public function index(Request $request): ZaposleniCollection
    {
        $this->authorize('view-any', Zaposleni::class);

        $search = $request->get('search', '');

        $zaposlenis = Zaposleni::search($search)
            ->latest('ZaposleniId')
            ->paginate();

        return new ZaposleniCollection($zaposlenis);
    }

    public function store(ZaposleniStoreRequest $request): ZaposleniResource
    {
        $this->authorize('create', Zaposleni::class);

        $validated = $request->validated();

        $zaposleni = Zaposleni::create($validated);

        return new ZaposleniResource($zaposleni);
    }

    public function show(
        Request $request,
        Zaposleni $zaposleni
    ): ZaposleniResource {
        $this->authorize('view', $zaposleni);

        return new ZaposleniResource($zaposleni);
    }

    public function update(
        ZaposleniUpdateRequest $request,
        Zaposleni $zaposleni
    ): ZaposleniResource {
        $this->authorize('update', $zaposleni);

        $validated = $request->validated();

        $zaposleni->update($validated);

        return new ZaposleniResource($zaposleni);
    }

    public function destroy(Request $request, Zaposleni $zaposleni): Response
    {
        $this->authorize('delete', $zaposleni);

        $zaposleni->delete();

        return response()->noContent();
    }
}
