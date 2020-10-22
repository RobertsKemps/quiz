<?php

namespace App\Console\Commands;

use App\Services\QuizDataUpdateService;
use Illuminate\Console\Command;
use App\Models\Category;

class QuizDataUpdateCommand extends Command
{
    private array $categories = Category::AVAILABLE_CATEGORIES;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz:data:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that calls QuizApi and updates all the data once a day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $quizUpdateService = new QuizDataUpdateService();

        foreach ($this->categories as $categorie) {
            $quizUpdateService->updateQuizData($categorie);
        }
    }
}
