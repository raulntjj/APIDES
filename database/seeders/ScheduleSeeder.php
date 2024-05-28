<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Schedule::create([
            "sub_criterion_id" => 1,
            "date" => "2025-01-01",
            "judge_id" => 1
        ]);

        Schedule::create([
            "sub_criterion_id" => 2,
            "date" => "2025-02-01",
            "judge_id" => 2
        ]);

        Schedule::create([
            "sub_criterion_id" => 3,
            "date" => "2025-03-01",
            "judge_id" => 3
        ]);

        Schedule::create([
            "sub_criterion_id" => 4,
            "date" => "2025-04-01",
            "judge_id" => 4
        ]);

        Schedule::create([
            "sub_criterion_id" => 5,
            "date" => "2025-05-01",
            "judge_id" => 5
        ]);
    }
}
