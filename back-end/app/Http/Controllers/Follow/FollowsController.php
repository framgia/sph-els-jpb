<?php

namespace App\Http\Controllers\Follow;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    // Get all follows activity in follows table
    public function index()
    {
        $follows = Follow::all();

        return response()->json(['data' => $follows], 200);
    }

    // Get all user's followings
    public function followings($followerID)
    {
        $followings = Follow::where('user_id', $followerID)->get();

        return response()->json(['data' => $followings], 200);
    }

    // Get all user's followers
    public function followers($followingID)
    {
        $followers = Follow::where('following_id', $followingID)->get();

        return response()->json(['data' => $followers], 200);
    }

    // Follow user
    public function store($following)
    {
        $follower = auth('sanctum')->user()->id;

        if ($follower === intval($following)) {
            return response()->json(['message' => 'We don\'t do that here'], 200);
        }

        $following_list = Follow::where([
            'user_id' => $follower,
            'following_id' => $following
        ])->first();

        if ($following_list) {
            return response(['message' => 'You already following this user']);
        }

        Follow::create([
            'user_id' => $follower,
            'following_id' => $following
        ])->activities()->create([
            'user_id' => $follower
        ]);



        return response()->json(['message' => 'Followed successfully'], 201);
    }

    // Unfollow user
    public function destroy($unfollowing)
    {
        $unfollower = auth('sanctum')->user()->id;

        if ($unfollower === intval($unfollowing)) {
            return response()->json(['message' => 'We don\'t do that here'], 200);
        }

        $following_list = Follow::where([
            'user_id' => $unfollower,
            'following_id' => $unfollowing
        ])->first();

        if ($following_list) {
            $following_list->delete();

            return response()->json(['message' => 'You unfollow this user'], 200);
        }

        return response()->json(['message' => 'You already unfollowed this user'], 200);
    }
}
