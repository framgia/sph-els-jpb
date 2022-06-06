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

            $cover = get_headers('https://source.unsplash.com/1600x900/?galaxy', 1);

            Image::create([
                'user_id' => $user->id,
                'avatar_url' => "https://api.multiavatar.com/{$user->id}/{$user->first_name}",
                'cover_url' => $cover["Location"],
            ]);
        };
    }
}
