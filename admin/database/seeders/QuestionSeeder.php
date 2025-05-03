<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'text' => 'What is the synonym of "rapid"?',
                'type' => 'multiple_choice',
                'options' => ['Fast', 'Slow', 'Lazy', 'Quiet'],
                'correct_answer' => 'Fast',
            ],
            [
                'text' => 'What is the antonym of "generous"?',
                'type' => 'multiple_choice',
                'options' => ['Kind', 'Stingy', 'Helpful', 'Rich'],
                'correct_answer' => 'Stingy',
            ],
            [
                'text' => 'How do you spell the plural of "analysis"?',
                'type' => 'short_answer',
                'correct_answer' => 'analyses',
            ],
            [
                'text' => 'Choose the correct form: "She _____ to the gym every day."',
                'type' => 'multiple_choice',
                'options' => ['go', 'goes', 'going', 'gone'],
                'correct_answer' => 'goes',
            ],
            [
                'text' => 'What is the meaning of "bilingual"?',
                'type' => 'short_answer',
                'correct_answer' => 'speaking two languages',
            ],
            [
                'text' => 'Which word is a noun?',
                'type' => 'multiple_choice',
                'options' => ['Run', 'Happy', 'Apple', 'Quickly'],
                'correct_answer' => 'Apple',
            ],
            [
                'text' => 'What is the past tense of "write"?',
                'type' => 'short_answer',
                'correct_answer' => 'wrote',
            ],
            [
                'text' => 'Select the correct article: "I saw ___ elephant."',
                'type' => 'multiple_choice',
                'options' => ['a', 'an', 'the', 'no article'],
                'correct_answer' => 'an',
            ],
            [
                'text' => 'Fill in the blank: "He has lived here ____ 2010."',
                'type' => 'multiple_choice',
                'options' => ['for', 'since', 'from', 'by'],
                'correct_answer' => 'since',
            ],
            [
                'text' => 'What does "IELTS" stand for?',
                'type' => 'short_answer',
                'correct_answer' => 'International English Language Testing System',
            ],
        ];

        foreach ($questions as $q) {
            Question::create([
                'text' => $q['text'],
                'type' => $q['type'],
                'options' => isset($q['options']) ? json_encode($q['options']) : null,
                'correct_answer' => $q['correct_answer'],
            ]);
        }
    }
}

