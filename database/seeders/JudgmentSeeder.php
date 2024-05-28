<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Judgment;

class JudgmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Judgment::create([
            "item_id" => 1,
            "aspect" => "Julgamento",
            "scores" => [
                "1" => "power",
                "2" => "resistence",
                "3" => "speed",
                "4" => "recovery"
            ]
        ]);

        Judgment::create([
            "item_id" => 2,
            "aspect" => "Julgamento",
            "scores" => [
                "1" => "creativity",
                "2" => "originality",
                "3" => "innovation"
            ]
        ]);

        Judgment::create([
            "item_id" => 3,
            "aspect" => "Julgamento",
            "scores" => [
                "1" => "clarity",
                "2" => "engagement",
                "3" => "persuasiveness",
                "4" => "organization",
                "5" => "professionalism"
            ]
        ]);

        Judgment::create([
            "item_id" => 4,
            "aspect" => "Julgamento",
            "scores" => [
                "1" => "collaboration",
                "2" => "communication",
                "3" => "cooperation"
            ]
        ]);

        Judgment::create([
            "item_id" => 5,
            "aspect" => "Julgamento",
            "scores" => [
                "1" => "analytical",
                "2" => "creative",
                "3" => "critical"
            ]
        ]);
    }
}
