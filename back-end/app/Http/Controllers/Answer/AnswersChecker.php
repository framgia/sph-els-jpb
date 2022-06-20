<?php

namespace App\Http\Controllers\Answer;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Choice;
use App\Models\Question;
use App\Models\WordsLearned;
use App\Models\Words_learned;
use Illuminate\Http\Request;

class AnswersChecker extends Controller
{
    public function checker($lessonID)
    {
        // Get User ID.
        $user = auth('sanctum')->user()->id;

        // Validator if the lesson was already been taken by this user.
        $lessonTaken = WordsLearned::where([
            'lesson_id' => $lessonID,
            'user_id' => $user
        ])->first();

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

        $getAllQuestions = Question::where('lesson_id', $lessonID)->get();

        foreach ($getAllQuestions as $question) {
            $getAllChoices = Choice::where('question_id', $question->id)->get();

            foreach ($getAllChoices as $choice) {
                $correct = $choice->is_correct;

                if ($correct) {
                    array_push($correctAnswers, $choice->id);
                }
            }
        };

        // Check user's answer with the lesson's correct answer then get the total score.
        $score = 0;
        $wordsLearned = array();
        $answerCorrections = array();

        for ($i = 0; $i < count($correctAnswers); $i++) {
            $chosenWord = Choice::where('id', $userAnswers[$i])->first();
            $correctWord = Choice::where('id', $correctAnswers[$i])->first();

            // Save all the user's answers data in the Answers table
            Answer::create([
                'user_id' => $user,
                'question_id' => $chosenWord->question_id,
                'choice_id' => $chosenWord->id,
                'is_correct' => $chosenWord->is_correct,
            ]);

            array_push($answerCorrections, [
                'choice' => $chosenWord->choice,
                'correct' => $correctWord->choice,
                'is_correct' => false,
            ]);

            // Get all the correct words from user.
            if ($correctAnswers[$i] === $userAnswers[$i]) {

                array_push($wordsLearned, $chosenWord);

                $answerCorrections[$i]['is_correct'] = true;

                $score++;
            };
        }

        // Save all the correct answers, and the lesson id taken to WordsLearned table.
        if ($score === 0) {
            WordsLearned::create([
                'user_id' => $user,
                'lesson_id' => $lessonID,
                'word_learned' => NULL,
            ])->activities()->create([
                'user_id' => $user
            ]);
        }

        foreach ($wordsLearned as $index => $word_learned) {
            $learnedWords = WordsLearned::create([
                'user_id' => $user,
                'lesson_id' => $lessonID,
                'word_learned' => $word_learned->choice,
            ]);

            // Save only 1 activity in activities table to back track.
            if ($index === count($wordsLearned) - 1) {
                $learnedWords->activities()->create([
                    'user_id' => $user
                ]);
            }
        }

        // If all the conditions are met, return the essential data for the front end.
        return response()->json([
            'score' => $score,
            'data' => $answerCorrections,
        ], 200);
    }
}
