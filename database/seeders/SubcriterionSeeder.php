<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcriterion;

class SubcriterionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Subcriterion::create([
            "criterion_id" => 1,
            "name" => "Física",
        ]);

        Subcriterion::create([
            "criterion_id" => 2,
            "name" => "Técnica",
        ]);
    }
}
