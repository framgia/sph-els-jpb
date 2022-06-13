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
    public function followings($follower_id)
    {
        $followings = Follow::where('user_id', $follower_id)->get();

        return response($followings);
        return response()->json(['data' => $followings], 200);
    }

    // Get all user's followers
    public function followers($following_id)
    {
        $followers = Follow::where('following_id', $following_id)->get();

        return response($followers);
        return response()->json(['data' => $followers], 200);
    }

    // Follow user
    public function store(Request $request)
    {
        $follower = $request['follower_id'];
        $following = $request['following_id'];

        $user = User::find($following);

        if (!$user) {
            return response()->json(['message' => 'User does not exist'], 404);
        }

        if ($follower === $following) {
            return response()->json(['message' => 'We don\'t do that here'], 200);
        }

        $following_list = Follow::where('user_id', $follower)
            ->where('following_id', $following)
            ->first();

        if ($following_list) {
            return response(['message' => 'You already following this user']);
        }

        Follow::create([
            'user_id' => $follower,
            'following_id' => $following
        ]);

        return response()->json(['message' => 'Followed successfully'], 201);
    }

    // Unfollow user
    public function destroy(Request $request)
    {
        $unfollower = $request['unfollower_id'];
        $unfollowing = $request['unfollowing_id'];

        $user = User::find($unfollowing);

        if (!$user) {
            return response()->json(['message' => 'User does not exist'], 404);
        }

        if ($unfollower === $unfollowing) {
            return response()->json(['message' => 'We don\'t do that here'], 200);
        }

        $following_list = Follow::where('user_id', $unfollower)
            ->where('following_id', $unfollowing)
            ->first();

        if ($following_list) {
            $following_list->delete();

            return response()->json(['message' => 'You unfollow this user'], 200);
        }

        return response()->json(['message' => 'You already unfollowed this user'], 404);
    }
}
