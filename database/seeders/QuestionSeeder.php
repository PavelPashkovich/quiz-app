<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('questions')->insert([
            [
                'text' => 'How much is "2 + 2"?',
                'quiz_id' => 1,
            ],
            [
                'text' => 'How much is "4 + 3?',
                'quiz_id' => 1,
            ],
            [
                'text' => 'How much is "2 + 7?',
                'quiz_id' => 1,
            ],
            [
                'text' => 'How much is "6 + 4?',
                'quiz_id' => 1,
            ],
            [
                'text' => 'How much is "5 - 3?',
                'quiz_id' => 1,
            ],
            [
                'text' => 'How much is "9 - 8?',
                'quiz_id' => 1,
            ],
            [
                'text' => 'How much is "12 - 6"?',
                'quiz_id' => 1,
            ],
            [
                'text' => 'How much is "14 - 9"?',
                'quiz_id' => 1,
            ],
            [
                'text' => 'How much is "5 * 3"?',
                'quiz_id' => 1,
            ],
            [
                'text' => 'How much is "8 / 2"?',
                'quiz_id' => 1,
            ],
        ]);
    }
}
