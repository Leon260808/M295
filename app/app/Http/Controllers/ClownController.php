<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClownRequest;
use App\Http\Resources\ClownResource;
use App\Models\Clown;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClownController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ClownResource::collection(Clown::all());
    }

    public function show(Clown $clown): ClownResource
    {
        return ClownResource::make($clown);
    }

    public function store(StoreClownRequest $request): JsonResponse
    {
        $clown = Clown::create($request->validated());

        return ClownResource::make($clown)
            ->response()
            ->setStatusCode(201);
    }

    public function update(StoreClownRequest $request, Clown $clown): ClownResource
    {
        $clown->update($request->validated());

        return ClownResource::make($clown);
    }

    public function destroy(Clown $clown): JsonResponse
    {
        $clown->delete();

        return response()->json(null, 204);
    }
}
