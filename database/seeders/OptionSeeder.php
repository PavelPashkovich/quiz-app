<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('options')->insert([
            [
                'text' => '3',
                'is_correct' => false,
                'question_id' => 1,
            ],
            [
                'text' => '5',
                'is_correct' => false,
                'question_id' => 1,
            ],
            [
                'text' => '4',
                'is_correct' => true,
                'question_id' => 1,
            ],
            [
                'text' => '0',
                'is_correct' => false,
                'question_id' => 1,
            ],

            [
                'text' => '6',
                'is_correct' => false,
                'question_id' => 2,
            ],
            [
                'text' => '7',
                'is_correct' => true,
                'question_id' => 2,
            ],
            [
                'text' => '9',
                'is_correct' => false,
                'question_id' => 2,
            ],
            [
                'text' => '8',
                'is_correct' => false,
                'question_id' => 2,
            ],

            [
                'text' => '9',
                'is_correct' => true,
                'question_id' => 3,
            ],
            [
                'text' => '8',
                'is_correct' => false,
                'question_id' => 3,
            ],
            [
                'text' => '10',
                'is_correct' => false,
                'question_id' => 3,
            ],
            [
                'text' => '11',
                'is_correct' => false,
                'question_id' => 3,
            ],

            [
                'text' => '12',
                'is_correct' => false,
                'question_id' => 4,
            ],
            [
                'text' => '11',
                'is_correct' => false,
                'question_id' => 4,
            ],
            [
                'text' => '9',
                'is_correct' => false,
                'question_id' => 4,
            ],
            [
                'text' => '10',
                'is_correct' => true,
                'question_id' => 4,
            ],

            [
                'text' => '1',
                'is_correct' => false,
                'question_id' => 5,
            ],
            [
                'text' => '2',
                'is_correct' => true,
                'question_id' => 5,
            ],
            [
                'text' => '3',
                'is_correct' => false,
                'question_id' => 5,
            ],
            [
                'text' => '8',
                'is_correct' => false,
                'question_id' => 5,
            ],

            [
                'text' => '1',
                'is_correct' => true,
                'question_id' => 6,
            ],
            [
                'text' => '0',
                'is_correct' => false,
                'question_id' => 6,
            ],
            [
                'text' => '2',
                'is_correct' => false,
                'question_id' => 6,
            ],
            [
                'text' => '7',
                'is_correct' => false,
                'question_id' => 6,
            ],

            [
                'text' => '7',
                'is_correct' => false,
                'question_id' => 7,
            ],
            [
                'text' => '8',
                'is_correct' => false,
                'question_id' => 7,
            ],
            [
                'text' => '6',
                'is_correct' => true,
                'question_id' => 7,
            ],
            [
                'text' => '5',
                'is_correct' => false,
                'question_id' => 7,
            ],

            [
                'text' => '5',
                'is_correct' => true,
                'question_id' => 8,
            ],
            [
                'text' => '6',
                'is_correct' => false,
                'question_id' => 8,
            ],
            [
                'text' => '4',
                'is_correct' => false,
                'question_id' => 8,
            ],
            [
                'text' => '9',
                'is_correct' => false,
                'question_id' => 8,
            ],

            [
                'text' => '10',
                'is_correct' => false,
                'question_id' => 9,
            ],
            [
                'text' => '15',
                'is_correct' => true,
                'question_id' => 9,
            ],
            [
                'text' => '20',
                'is_correct' => false,
                'question_id' => 9,
            ],
            [
                'text' => '25',
                'is_correct' => false,
                'question_id' => 9,
            ],

            [
                'text' => '1',
                'is_correct' => false,
                'question_id' => 10,
            ],
            [
                'text' => '2',
                'is_correct' => false,
                'question_id' => 10,
            ],
            [
                'text' => '6',
                'is_correct' => false,
                'question_id' => 10,
            ],
            [
                'text' => '4',
                'is_correct' => true,
                'question_id' => 10,
            ],
        ]);
    }
}
