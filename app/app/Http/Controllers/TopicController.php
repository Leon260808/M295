<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\JsonResponse;

class TopicController extends Controller
{
    public function posts(string $slug): JsonResponse
    {
        return response()->json(
            Topic::where('slug', '=', $slug)->firstOrFail()
                ->posts()->with('author')->get()
                ->map(fn($post) => [
                    'id'      => $post->id,
                    'title'   => $post->title,
                    'content' => $post->content,
                    'topic'   => $post->topic,
                    'author'  => $post->author,
                ])
        );
    }
}
