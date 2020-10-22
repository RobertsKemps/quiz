<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Define all categories that wil be called from QuizApi
     */
    private array $availableCategories = [
        'Linux',
        'Bash',
        'Docker',
        'SQL',
        'CMS',
        'Code',
        'DevOPS',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];


    public function getCategories()
    {
        return $this->availableCategories;
    }
}
