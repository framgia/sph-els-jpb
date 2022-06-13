<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\ChoiceSeeder;
use Database\Seeders\FollowSeeder;
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
        $this->call([
            UserSeeder::class,
            LessonSeeder::class,
            QuestionSeeder::class,
            ChoiceSeeder::class,
            ImageSeeder::class,
            FollowSeeder::class
        ]);
    }
}
