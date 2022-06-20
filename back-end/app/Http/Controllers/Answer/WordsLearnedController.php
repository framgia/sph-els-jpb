<?php

namespace App\Http\Controllers\Answer;

use App\Models\Lesson;
use App\Models\Question;
use App\Models\WordsLearned;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WordsLearnedController extends Controller
{
    // Get words learned under lesson's taken with score and timestamps.
    public function index()
    {
        $user = auth('sanctum')->user()->id;

        // Filter the duplicated lesson id's.
        $lessonTaken = WordsLearned::where('user_id', $user)->get();

        $lessonList = array();

        foreach ($lessonTaken as $lesson) {
            array_push($lessonList, $lesson->lesson_id);
        }

        $uniqueLessonList = array_keys(array_flip($lessonList));


        // Get all the taken lesson of this user.
        $getLessonDetails = array();

        foreach ($uniqueLessonList as $lessonId) {
            array_push($getLessonDetails, $this->show($lessonId)->original);
        }

        return response($getLessonDetails);
    }

    // Get words learned under lesson's taken with score and timestamps.
    public function show($lessonId)
    {
        $user = auth('sanctum')->user()->id;

        $lesson = WordsLearned::where([
            'lesson_id' => $lessonId,
            'user_id' => $user
        ])->get();

        $lessonTitle = Lesson::where('id', $lessonId)->first()->title;

        $totalQuestions = count(Question::where('lesson_id', $lessonId)->get());

        $score = $lesson[0]->word_learned === null ? 0 : count($lesson);

        // Create data structure for response. 
        $data = [
            'user' => $lesson[0]->user_id,
            'lesson_title' => $lessonTitle,
            'time_taken' => $lesson[0]->created_at,
            'total_item' => $totalQuestions,
            'user_score' => $score,
            'words_learned' => $lesson
        ];

        return response($data);
    }
}
