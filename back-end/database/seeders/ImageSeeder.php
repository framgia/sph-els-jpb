<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            Image::factory(1)->create([
                'avatar_url' => "https://api.multiavatar.com/{$user->id}/{$user->first_name}",
                'user_id' => $user->id,
            ]);
        };
    }
}
