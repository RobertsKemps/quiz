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
    const AVAILABLE_CATEGORIES = [
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
}
