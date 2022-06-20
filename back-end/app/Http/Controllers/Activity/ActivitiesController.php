<?php

namespace App\Http\Controllers\Activity;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Words_learned;

class ActivitiesController extends Controller
{
    public function index()
    {
        $activities = Activity::all();

        $arrayData = array();
        foreach ($activities as $activity) {
            $getData = $this->show($activity->id);

            array_push($arrayData, $getData->original);
        }

        return response($arrayData);
    }

    public function show($activityID)
    {
        $userLoggedIn = auth('sanctum')->user()->id;

        $activity = Activity::find($activityID);
        $type = $activity->activitiable_type;

        $activityType = explode('\\', $type)[count(explode('\\', $type)) - 1];
        $timeStamps = $activity->created_at;

        if ($activityType === 'Words_learned') {
            $words_learned = Activity::find($activityID)->activitiable;

            $userTaker = $words_learned->user_id;

            $user = User::find($userTaker);
            $name = $userLoggedIn === $userTaker ? 'You' : "$user->first_name $user->last_name";

            $lessonID = $words_learned->lesson_id;
            $lesson = Lesson::find($lessonID);

            $learnedWords =  Words_learned::where([
                'lesson_id' => $lessonID,
                'user_id' => $userTaker
            ])->get();
            $score = $learnedWords[0]->word_learned === null ? 0 : count($learnedWords);

            $data = [
                'user_id' => $userTaker,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'account_age' => $user->created_at,
                'created_at' => $timeStamps,
                'message' => "$name finished $lesson->title and learned $score total words.",
            ];

            return response()->json([
                'data' => $data,
            ], 200);
        }

        $follows = Activity::find($activityID)->activitiable;

        $follower = $follows->user_id;
        $following = User::find($follows->following_id);

        $user = User::find($follower);

        $followerName = $userLoggedIn === $follower ? 'You' : "$user->first_name $user->last_name";
        $followingName = "$following->first_name $following->last_name";

        $data = [
            'user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'account_age' => $user->created_at,
            'created_at' => $timeStamps,
            'message' => "$followerName followed $followingName",
        ];

        return response()->json([
            'data' => $data,
        ], 200);
    }
}
