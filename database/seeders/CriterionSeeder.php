<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Criterion;

class CriterionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Criterion::create([
            "name" => "SoftSkills",
            "points" => 25
        ]);

        Criterion::create([
            "name" => "Technical Knowledge",
            "points" => 30
        ]);

        Criterion::create([
            "name" => "Teamwork",
            "points" => 20
        ]);

        Criterion::create([
            "name" => "Communication",
            "points" => 15
        ]);

        Criterion::create([
            "name" => "Creativity",
            "points" => 35
        ]);
    }
}
