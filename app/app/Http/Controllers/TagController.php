<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function posts(string $tagSlug): JsonResponse
    {
        return response()->json(
            Tag::where('slug', '=', $tagSlug)->firstOrFail()
                ->posts()->with(['topic', 'author', 'tags'])->get()
        );
    }
}
