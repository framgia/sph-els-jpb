<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Choice extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'question_id',
        'is_correct',
        'created_at',
        'updated_at',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
