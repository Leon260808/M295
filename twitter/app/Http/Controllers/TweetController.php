<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTweetRequest;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::with(['user' => fn ($query) => $query->withSum('tweets', 'likes')])
            ->latest()
            ->paginate(100);

        return TweetResource::collection($tweets);
    }

    public function store(StoreTweetRequest $request)
    {
        $tweet = new Tweet;
        $tweet->text = $request->text;
        $tweet->user_id = $request->user()->id;
        $tweet->save();

        return TweetResource::make($tweet);
    }

    public function like(Tweet $tweet)
    {
        $tweet->increment('likes');

        return TweetResource::make($tweet);
    }
}
