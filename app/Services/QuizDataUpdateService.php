<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
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
     * @return array
     */
    public function updateQuizData(string $category): array
    {
        if ('' == $category) {
            return null;
        }

        $this->categoryModel = Category::where('name', $category)->first();

        if (!$this->categoryModel instanceof Category) {
            return null;
        }

        $apiResponse = Http::get('https://quizapi.io/api/v1/questions', [
            'apiKey' => $this->quizApiKey,
            'category' => $category,
            'limit' => $this->questionAmount,
        ]);
        $responseJson = json_decode($apiResponse->body());

        $allSavedQuestions = Question::all();
        $updatedQuestionAmount = 0;

        foreach ($responseJson as $response) {
            if ($allSavedQuestions->contains('text', $response->question)) {
                continue;
            }

            $question = Question::saveQuestionFromApiRequest($response, $this->categoryModel);
            Answer::saveAnswersFromApiRequest($response, $question);
            $updatedQuestionAmount++;
        }

        $quizDataUpdate = [
            'categoryId' => $this->categoryModel->id,
            'statusCode' => $apiResponse->status(),
            'newQuestions' => $updatedQuestionAmount,
            'deletedQuestions' => 0,
        ];

        return $quizDataUpdate;
    }
}
