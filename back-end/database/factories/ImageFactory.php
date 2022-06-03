<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'avatar_url' => 'https://api.multiavatar.com/' . $this->faker->numberBetween(000000, 999999),
            'cover_url' => 'https://source.unsplash.com/1600x900/?beach'
        ];
    }
}
