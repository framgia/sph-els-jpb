<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\ChoiceSeeder;
use Database\Seeders\LessonSeeder;
use Database\Seeders\QuestionSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            LessonSeeder::class,
            QuestionSeeder::class,
            ChoiceSeeder::class,
            ImageSeeder::class
        ]);
    }
}
