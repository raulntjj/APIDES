<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Judgment;

class JudgmentSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Judgment::create([
            "item_id" => 1,
            "evaluation_id" => 1,
            "attempt" => 30,
            "correctAttempt" => 20,
            "failAttempt" => 10,
            "score" => 6.3
        ]);

        Judgment::create([
            "item_id" => 2,
            "evaluation_id" => 1,
            "attempt" => 30,
            "correctAttempt" => 20,
            "failAttempt" => 10,
            "score" => 6.2
        ]);

        Judgment::create([
            "item_id" => 3,
            "evaluation_id" => 1,
            "attempt" => 30,
            "correctAttempt" => 20,
            "failAttempt" => 10,
            "score" => 8.3
        ]);

        Judgment::create([
            "item_id" => 4,
            "evaluation_id" => 1,
            "score" => 5.80,
        ]);
    }
}
