<?php

namespace Database\Seeders;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Question::all() as $question) {

            // Create 1 correct choice
            Choice::create([
                'question_id' => $question->id,
                'choices' => 'correct',
                'is_correct' => true,
            ]);

            // Generate 3 random choices
            Choice::factory(3)->create([
                'question_id' => $question->id,
            ]);
        }
    }
}
