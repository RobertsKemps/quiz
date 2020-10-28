<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'questionId',
        'text',
        'isRight',
        'created_at',
        'updated_at',
    ];

    public static function saveAnswersFromApiRequest(object $response, Question $question)
    {
        $answer = new Answer();
        $insertQuestions = [];
        foreach ($response->answers as $key => $answer) {
            if (is_null($answer)) {
                continue;
            }

            $correctAnswerKey = $key . '_correct';
            if (!$correctAnswerKey) {
                continue;
            }

            $isAnswerRight = $response->correct_answers->$correctAnswerKey;
            $now = Carbon::now()->toDateTimeString();
            $singleAnswerModel = [
                'questionId' => $question->id,
                'text' => $answer,
                'isRight' => filter_var($isAnswerRight, FILTER_VALIDATE_BOOLEAN),
                'created_at' => $now,
                'updated_at' => $now,
            ];

            array_push($insertQuestions, $singleAnswerModel);
        }

        Answer::insert($insertQuestions);
    }
}
