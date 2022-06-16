<?php

namespace App\Http\Controllers\Answer;

use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Words_learned;
use App\Http\Controllers\Controller;

class WordsLearned extends Controller
{
    // Get words learned under lesson's taken with score and timestamps.
    public function index()
    {
        $user = auth('sanctum')->user()->id;

        // Filter the duplicated lesson id's.
        $lessonTaken = Words_learned::where('user_id', $user)->get();

        $lessonList = array();

        foreach ($lessonTaken as $lesson) {
            array_push($lessonList, $lesson->lesson_id);
        }

        $uniqueLessonList = array_keys(array_flip($lessonList));


        // Get all the taken lesson of this user.
        $getLessonDetails = array();

        foreach ($uniqueLessonList as $lesson_id) {
            array_push($getLessonDetails, $this->show($lesson_id)->original);
        }

        return response($getLessonDetails);
    }

    // Get words learned under lesson's taken with score and timestamps.
    public function show($lesson_id)
    {
        $lesson = Words_learned::where('lesson_id', $lesson_id)->get();
        $lessonTitle = Lesson::where('id', $lesson_id)->first()->title;

        $totalQuestions = count(Question::where('lesson_id', $lesson_id)->get());

        // Create data structure for response. 
        $data = [
            'user' => $lesson[0]->user_id,
            'lesson_title' => $lessonTitle,
            'time_taken' => $lesson[0]->created_at,
            'total_item' => $totalQuestions,
            'user_score' => count($lesson),
            'words_learned' => $lesson
        ];

        return response($data);
    }
}
