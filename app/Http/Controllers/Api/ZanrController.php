<?php

namespace App\Http\Controllers\Api;

use App\Models\Zanr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ZanrResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ZanrCollection;
use App\Http\Requests\ZanrStoreRequest;
use App\Http\Requests\ZanrUpdateRequest;

class ZanrController extends Controller
{
    public function index(Request $request): ZanrCollection
    {
        $this->authorize('view-any', Zanr::class);

        $search = $request->get('search', '');

        $zanrs = Zanr::search($search)
            ->latest('ZanrId')
            ->paginate();

        return new ZanrCollection($zanrs);
    }

    public function store(ZanrStoreRequest $request): ZanrResource
    {
        $this->authorize('create', Zanr::class);

        $validated = $request->validated();

        $zanr = Zanr::create($validated);

        return new ZanrResource($zanr);
    }

    public function show(Request $request, Zanr $zanr): ZanrResource
    {
        $this->authorize('view', $zanr);

        return new ZanrResource($zanr);
    }

    public function update(ZanrUpdateRequest $request, Zanr $zanr): ZanrResource
    {
        $this->authorize('update', $zanr);

        $validated = $request->validated();

        $zanr->update($validated);

        return new ZanrResource($zanr);
    }

    public function destroy(Request $request, Zanr $zanr): Response
    {
        $this->authorize('delete', $zanr);

        $zanr->delete();

        return response()->noContent();
    }
}
