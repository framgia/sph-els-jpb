<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WordsLearned extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'activitiable');
    }
}
