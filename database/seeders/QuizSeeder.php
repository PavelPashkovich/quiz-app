<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('quizzes')->insert([
            [
                'title' => 'Mathematics for kids',
                'description' => 'This quiz contains math questions for kids',
                'is_published' => true,
                'user_id' => 1,
            ]
        ]);
    }
}
