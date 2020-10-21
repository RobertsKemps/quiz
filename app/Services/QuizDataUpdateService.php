<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Answer;
use App\Models\Difficulty;
use App\Models\Question;
use App\Models\QuizDataUpdate;
use Illuminate\Support\Facades\Http;

class QuizDataUpdateService
{
    private string $quizApiKey;
    private int $questionAmount;
    private QuizDataUpdate $quizDataModel;
    private Answer $answerModel;
    private Difficulty $difficultyModel;
    private Question $questionModel;

    public function __construct()
    {
        $this->quizApiKey = config('services.quizApi.key');
        $this->questionAmount = 20;
        $this->quizDataModel = new QuizDataUpdate();
        $this->answerModel = new Answer();
        $this->difficultyModel = new Difficulty();
        $this->questionModel = new Question();
    }

    public function updateQuizData()
    {


        $response = Http::get('https://quizapi.io/api/v1/questions', [
            'apiKey' => $this->quizApiKey,
            'limit' => $this->questionAmount,
        ]);

        $responseJson = json_decode($response->body());

        foreach ($responseJson as $question) {
            dd($question);
        }

        return 0;
    }
}
