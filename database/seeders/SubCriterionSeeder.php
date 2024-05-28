<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCriterion;

class SubCriterionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        SubCriterion::create([
            "name" => "SoftSkills",
            "points" => 25
        ]);

        SubCriterion::create([
            "name" => "Leadership",
            "points" => 10
        ]);

        SubCriterion::create([
            "name" => "Adaptability",
            "points" => 8
        ]);

        SubCriterion::create([
            "name" => "Time Management",
            "points" => 7
        ]);

        SubCriterion::create([
            "name" => "Problem Solving",
            "points" => 10
        ]);
    }
}
