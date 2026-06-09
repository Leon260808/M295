<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\JsonResponse;

class PlantController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Plant::all());
    }

    public function show(string $slug): JsonResponse
    {
        return response()->json(Plant::where('slug', '=', $slug)->firstOrFail());
    }
}
