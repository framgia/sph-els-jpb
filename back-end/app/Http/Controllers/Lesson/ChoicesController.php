<?php

namespace App\Http\Controllers\Lesson;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Traits\AdminTrait;
use App\Http\Controllers\Controller;

class ChoicesController extends Controller
{

    // Call traits for reusable codes for checking if the user is admin
    use AdminTrait;

    // Display a listing of the Choices
    public function index()
    {
        $choices = Choice::all();

        return response()->json([
            'data' => $choices
        ], 200);
    }

    // Store a newly created Choice in storage.
    public function store(Request $request)
    {
        $this->isAdmin();

        $data = $request->validate([
            'question_id' => 'required|integer',
            'choice' => 'required|string|max:191',
            'is_correct' => 'required|boolean|max:191',
        ]);

        Choice::create([
            'question_id' => $data['question_id'],
            'choice' => $data['choice'],
            'is_correct' => $data['is_correct'],
        ]);

        return response()->json([
            'message' => "Choice under question $request->question_id Created Successfully!"
        ], 201);
    }

    // Display the specified Choice.
    public function show($choice_id)
    {
        $choice = Choice::find($choice_id);

        return response()->json([
            'data' => $choice
        ], 200);
    }

    // Update the specified Choice in storage.
    public function update(Request $request, $choice_id)
    {
        $this->isAdmin();

        $data = $request->validate([
            'choice' => 'required|string|max:191',
        ]);

        Choice::find($choice_id)->update([
            'choice' => $data['choice'],
        ]);

        return response()->json([
            'message' => 'Choice Updated Successfully'
        ], 201);
    }

    // Remove the specified Choice from storage.
    public function destroy($choice_id)
    {
        $this->isAdmin();

        $choice = Choice::find($choice_id);

        if (!$choice) return response()->json(['message' => 'This choice was already been deleted'], 200);

        $choice->delete();
        return response()->json(['message' => 'Choice Deleted Successfully'], 200);
    }
}
