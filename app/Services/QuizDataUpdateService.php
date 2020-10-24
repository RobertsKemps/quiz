<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\QuizDataUpdate;
use Illuminate\Support\Facades\Http;

class QuizDataUpdateService
{
    private string $quizApiKey;
    private int $questionAmount;
    private Category $categoryModel;

    public function __construct()
    {
        $this->quizApiKey = config('services.quizApi.key');
        $this->questionAmount = config('services.quizApi.questionsPerApiCall');
    }

    /**
     * Calls QuizApi questions endpoint and returns questions
     *
     * @param string $categories
     * @return void
     */
    public function updateQuizData(string $category): void
    {
        if ('' == $category) {
            return;
        }

        $this->categoryModel = Category::where('name', $category)->first();

        if (!$this->categoryModel instanceof Category) {
            return;
        }

        $response = Http::get('https://quizapi.io/api/v1/questions', [
            'apiKey' => $this->quizApiKey,
            'category' => $category,
            'limit' => $this->questionAmount,
        ]);

        $responseJson = json_decode($response->body());

        foreach ($responseJson as $response) {
            $question = $this->saveQuestion($response);
            $this->saveRequestAnswers($response, $question);
        }
    }

    /**
     * Saves and returns Question model
     *
     * @param object $response
     * @return Question
     */
    private function saveQuestion(object $response): Question
    {
        $question = new Question();
        $question->categoryId = $this->categoryModel->id;
        $question->text = $response->question;
        $question->save();

        return $question;
    }

    /**
     * Saves answer from request
     *
     * @param object $response
     * @param Question $question
     * @return void
     */
    private function saveRequestAnswers(object $response, Question $question): void
    {
        foreach ($response->answers as $key => $answer) {
            $correctAnswerKey = $key . '_correct';
            if (!$correctAnswerKey) {
                continue;
            }

            $isAnswerRight = $response->correct_answers->$correctAnswerKey;

            $answer = new Answer();
            $answer->questionId = $question->id;
            $answer->text = $response->question;
            $answer->isRight = filter_var($isAnswerRight, FILTER_VALIDATE_BOOLEAN);
            $answer->save();
        }
    }
}
