<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Collection;

class ApiResponseService
{
    private Question $question;
    private Collection $answers;

    public function returnJsonDataForRandomQuestion()
    {
        $this->question = Question::inRandomOrder()->first();
        $this->answers = Answer::where('questionId', $this->question->id)->get();

        $response = [
            'question' => $this->question->text,
            'answers' => []
        ];

        foreach ($this->answers as $key => $answer) {
            $response['answers'][$key] = [
                'answerId' => $answer->id,
                'text' => $answer->text,
                'isRight' => $answer->isRight,
            ];
        }

        return $response;
    }
}
