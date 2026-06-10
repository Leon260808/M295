<?php

namespace App\Http\Controllers;

use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::with('user')->latest()->paginate(100);

        return TweetResource::collection($tweets);
    }

    public function store(Request $request)
    {
        $tweet = new Tweet;
        $tweet->text = $request->text;
        $tweet->user_id = $request->user()->id;
        $tweet->save();

        return TweetResource::make($tweet);
    }
}
