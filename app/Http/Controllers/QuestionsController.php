<?php

namespace App\Http\Controllers;

use App\Services\ApiResponseService;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function getQuestion(Request $request)
    {

        $apiResponseService = new ApiResponseService();
        $response = $apiResponseService->returnJsonDataForRandomQuestion();

        return response()->json($response);
    }
}
