<?php

namespace App\Http\Controllers\Follow;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function index()
    {
        $follows = Follow::all();

        return response()->json(['data' => $follows], 200);
    }

    public function followings($follower_id)
    {
        $followings = Follow::where('user_id', $follower_id)->get();

        return response($followings);
        return response()->json(['data' => $followings], 200);
    }

    public function followers($following_id)
    {
        $followers = Follow::where('following_id', $following_id)->get();

        return response($followers);
        return response()->json(['data' => $followers], 200);
    }
}
