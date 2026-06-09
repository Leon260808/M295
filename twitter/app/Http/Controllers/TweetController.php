<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

class TweetController extends Controller
{
    public function index()
    {
        return ['data' => Tweet::all()];
    }
}
