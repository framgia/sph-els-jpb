<?php

namespace App\Http\Controllers\Lesson;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Traits\AdminTrait;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    // Call traits for reusable codes for checking if the user is admin
    use AdminTrait;

    // Display a listing of the Questions
    public function index()
    {
        $questions = Question::all();

        return response()->json([
            'data' => $questions
        ], 200);
    }

    // Store a newly created Question in storage.
    public function store(Request $request)
    {
        $this->isAdmin();

        $data = $request->validate([
            'lesson_id' => 'required|integer',
            'question' => 'required|string|max:191',
        ]);

        Question::create([
            'lesson_id' => $data['lesson_id'],
            'question' => $data['question'],
        ]);

        return response()->json([
            'message' => "Question under lesson $request->lesson_id Created Successfully!"
        ], 201);
    }

    // Display the specified Question.
    public function show($question_id)
    {
        $question = Question::find($question_id);

        return response()->json([
            'data' => $question
        ], 200);
    }

    // Update the specified Question in storage.
    public function update(Request $request, $question_id)
    {
        $this->isAdmin();

        $data = $request->validate([
            'question' => 'required|string|max:191',
        ]);

        Question::find($question_id)->update([
            'question' => $data['question'],
        ]);

        return response()->json([
            'message' => 'Question Updated Successfully'
        ], 201);
    }

    // Remove the specified Question from storage.
    public function destroy($question_id)
    {
        $this->isAdmin();

        $question = Question::find($question_id);

        if (!$question) return response()->json(['message' => 'This question was already been deleted'], 200);

        $question->delete();
        return response()->json(['message' => 'Question Deleted Successfully'], 200);
    }
}
