<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Evaluation;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Evaluation::create([
            "event_id" => 1,
            "modality_id" => 1,
            "criterion_id" => 1,
            "subCriterion_id" => 1,
            "item_id" => 1,
            "judgment_id" => 1
        ]);

        Evaluation::create([
            "event_id" => 1,
            "modality_id" => 2,
            "criterion_id" => 2,
            "subCriterion_id" => 2,
            "item_id" => 2,
            "judgment_id" => 2
        ]);

        Evaluation::create([
            "event_id" => 1,
            "modality_id" => 3,
            "criterion_id" => 3,
            "subCriterion_id" => 3,
            "item_id" => 3,
            "judgment_id" => 3
        ]);

        Evaluation::create([
            "event_id" => 1,
            "modality_id" => 4,
            "criterion_id" => 4,
            "subCriterion_id" => 4,
            "item_id" => 4,
            "judgment_id" => 4
        ]);

        Evaluation::create([
            "event_id" => 1,
            "modality_id" => 5,
            "criterion_id" => 5,
            "subCriterion_id" => 5,
            "item_id" => 5,
            "judgment_id" => 5
        ]);
    }
}
