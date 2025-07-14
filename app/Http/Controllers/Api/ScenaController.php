<?php

namespace App\Http\Controllers\Api;

use App\Models\Scena;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScenaResource;
use App\Http\Resources\ScenaCollection;
use App\Http\Requests\ScenaStoreRequest;
use App\Http\Requests\ScenaUpdateRequest;

class ScenaController extends Controller
{
    public function index(Request $request): ScenaCollection
    {
        $this->authorize('view-any', Scena::class);

        $search = $request->get('search', '');

        $scenas = Scena::search($search)
            ->latest('ScenaId')
            ->paginate();

        return new ScenaCollection($scenas);
    }

    public function store(ScenaStoreRequest $request): ScenaResource
    {
        $this->authorize('create', Scena::class);

        $validated = $request->validated();

        $scena = Scena::create($validated);

        return new ScenaResource($scena);
    }

    public function show(Request $request, Scena $scena): ScenaResource
    {
        $this->authorize('view', $scena);

        return new ScenaResource($scena);
    }

    public function update(
        ScenaUpdateRequest $request,
        Scena $scena
    ): ScenaResource {
        $this->authorize('update', $scena);

        $validated = $request->validated();

        $scena->update($validated);

        return new ScenaResource($scena);
    }

    public function destroy(Request $request, Scena $scena): Response
    {
        $this->authorize('delete', $scena);

        $scena->delete();

        return response()->noContent();
    }
}
