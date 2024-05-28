<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Score;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Score::create([
            "evaluation_id" => 1,
            "participant_id" => 1,
            "points" => 78
        ]);

        Score::create([
            "evaluation_id" => 2,
            "participant_id" => 2,
            "points" => 85
        ]);

        Score::create([
            "evaluation_id" => 3,
            "participant_id" => 3,
            "points" => 92
        ]);

        Score::create([
            "evaluation_id" => 4,
            "participant_id" => 4,
            "points" => 79
        ]);

        Score::create([
            "evaluation_id" => 5,
            "participant_id" => 5,
            "points" => 88
        ]);
    }
}
