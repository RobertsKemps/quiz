<?php

namespace App\Http\Controllers;

use App\Models\QuizDataUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuizDataUpdateController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizDataUpdate  $quizDataUpdate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizDataUpdate $quizDataUpdate)
    {
        //TODO: Create seperate service for extracting and storing data from api

        // Documentation https://quizapi.io/docs/1.0/overview
        $response = Http::get('https://quizapi.io/api/v1/questions', [
            'apiKey' => config('services.quizApi.key'),
            'limit' => 10,
        ]);

        return $response->body();
    }
}
