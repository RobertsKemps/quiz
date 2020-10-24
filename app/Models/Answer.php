<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'questionId',
        'text',
        'isRight',
    ];

    public static function saveAnswerFromApiRequest(object $response, Question $question)
    {
        $answerModel = new Answer();
        foreach ($response->answers as $key => $answer) {
            $correctAnswerKey = $key . '_correct';
            if (!$correctAnswerKey) {
                continue;
            }

            $isAnswerRight = $response->correct_answers->$correctAnswerKey;
            $answerDataArray = [
                'questionId' => $question->id,
                'text' => $response->question,
                'isRight' => filter_var($isAnswerRight, FILTER_VALIDATE_BOOLEAN),
            ];

            $answerModel->fill($answerDataArray);
        }

        $answerModel->save();
    }
}
