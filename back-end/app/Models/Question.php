<?php

namespace App\Models;

use App\Models\Choice;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'correct_answer',
    ];


    public function choice()
    {
        return $this->hasMany(Choice::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
