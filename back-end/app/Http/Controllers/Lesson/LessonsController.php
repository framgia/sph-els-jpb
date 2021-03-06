<?php

namespace App\Http\Controllers\Lesson;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Traits\AdminTrait;
use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;


class LessonsController extends Controller
{
    // Call traits for reusable codes for checking if the user is admin
    use AdminTrait;

    // Display a listing of the Lessons
    public function index()
    {
        $lessons = Lesson::all();

        return response()->json([
            'data' => $lessons
        ], 200);
    }

    // Store a newly created Lesson in storage.
    public function store(Request $request)
    {
        $this->isAdmin();

        $data = $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:191',
        ]);

        Lesson::create([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        $lesson_id = Lesson::latest()->first()->id;

        return response()->json([
            'message' => 'Lesson Created Successfully',
            'lesson_id' => $lesson_id
        ], 201);
    }

    // Display the specified Lesson.
    public function show($lesson_id)
    {
        $lesson = Lesson::find($lesson_id);

        return response()->json([
            'data' => $lesson
        ], 200);
    }

    // Update the specified Lesson in storage.
    public function update(Request $request, $lesson_id)
    {
        $this->isAdmin();

        $data = $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:191',
        ]);

        Lesson::find($lesson_id)->update([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        return response()->json([
            'message' => 'Lesson Updated Successfully'
        ], 201);
    }

    // Remove the specified Lesson from storage.
    public function destroy($lesson_id)
    {
        $this->isAdmin();

        $lesson = Lesson::find($lesson_id);

        if (!$lesson) return response()->json(['message' => 'This Lesson was already been deleted'], 200);

        $lesson->delete();
        return response()->json(['message' => 'Lesson Deleted Successfully'], 200);
    }

    // Get Lesson with its questions and choices
    public function completeLesson($lesson_id)
    {
        $lesson = Lesson::find($lesson_id);
        $questions = Question::where('lesson_id', $lesson_id)->get();

        $questionAndChoices = array();

        foreach ($questions as $question) {
            $choice = Choice::where('question_id', $question->id)->get();

            array_push($questionAndChoices, [
                "id" => $question->id,
                "question" => $question->question,
                "choices" => $choice
            ]);
        }

        $data = [
            'lesson' => $lesson,
            'questions' => $questionAndChoices
        ];

        return response()->json([
            'data' => $data
        ], 200);
    }

    // Search lesson by title name
    public function search($lesson_name)
    {
        $result = Lesson::where("title", "like", "%$lesson_name%")->get();

        if (count($result) === 0) return response()->json([
            'message' => "Can't find $lesson_name in the lessons list"
        ], 200);

        return response()->json([
            'data' => $result
        ], 200);
    }
}
