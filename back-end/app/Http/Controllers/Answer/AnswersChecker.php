<?php

namespace App\Http\Controllers\Answer;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Words_learned;
use Illuminate\Http\Request;

class AnswersChecker extends Controller
{
    public function checker(Request $request, $lesson_id)
    {
        // Get User ID.
        $user = auth('sanctum')->user()->id;

        // Validator if the lesson is already been taken by this user
        $lessonTaken = Words_learned::where('lesson_id', $lesson_id)->first();

        if ($lessonTaken)  return response()->json([
            'message' => 'You cannot repeat the lessons that you have already taken.',
        ], 200);

        // Get all the User's answers.
        $choices = json_decode(file_get_contents("php://input"));

        $userAnswers = array();

        foreach ($choices as $choice) {
            array_push($userAnswers, $choice->choice_id);
        }

        // Get all the lesson's correct answers.
        $correctAnswers = array();

        $getAllQuestions = Question::where('lesson_id', $lesson_id)->get();

        foreach ($getAllQuestions as $question) {
            $getAllChoices = Choice::where('question_id', $question->id)->get();

            foreach ($getAllChoices as $choice) {
                $correct = $choice->is_correct;

                if ($correct) {
                    array_push($correctAnswers, $choice->id);
                }
            }
        };

        // Check user's answer from the lesson's correct answer then get the total score.
        $score = 0;
        $wordsLearned = array();
        $answerCorrections = array();

        for ($i = 0; $i < count($correctAnswers); $i++) {
            // Get all the correct words from user.
            $chosenWord = Choice::where('id', $userAnswers[$i])->first();
            $correctWord = Choice::where('id', $correctAnswers[$i])->first();

            array_push($answerCorrections, [
                'choice' => $chosenWord->choice,
                'correct' => $correctWord->choice,
                'is_correct' => false,
            ]);

            if ($correctAnswers[$i] === $userAnswers[$i]) {

                array_push($wordsLearned, $chosenWord);

                $answerCorrections[$i]['is_correct'] = true;

                $score++;
            };
        }

        // Save all the correct answers and the lesson taken to words_learned table.
        if ($score === 0) {
            Words_learned::create([
                'user_id' => $user,
                'lesson_id' => $lesson_id,
                'word_learned' => NULL,
            ]);
        }

        foreach ($wordsLearned as $word_learned) {
            Words_learned::create([
                'user_id' => $user,
                'lesson_id' => $lesson_id,
                'word_learned' => $word_learned->choice,
            ]);
        }

        return response()->json([
            'score' => $score,
            'data' => $answerCorrections,
        ], 200);
    }
}
