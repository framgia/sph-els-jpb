<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Answer;
use App\Models\WordsLearned;
use App\Models\Follow;
use App\Models\Activity;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = ['is_admin'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'is_admin',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function follow()
    {
        return $this->hasMany(Follow::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }

    public function wordsLearned()
    {
        return $this->hasMany(WordsLearned::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
