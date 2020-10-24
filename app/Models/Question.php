<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * Save and return question that was recieved from api request
     *
     * @param object $response
     * @return self
     */
    public static function saveQuestionFromApiRequest(object $response, Category $category): self
    {
        $question = new Question();
        $question->categoryId = $category->id;
        $question->text = $response->question;
        $question->save();

        return $question;
    }
}
