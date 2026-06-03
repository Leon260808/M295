<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Post::with('topic')->get()->map(fn($post) => [
                'id'      => $post->id,
                'title'   => $post->title,
                'content' => $post->content,
                'topic'   => $post->topic->name,
            ])
        );
    }
}
