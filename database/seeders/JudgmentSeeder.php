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
                "Chutes feitos",
                "Chutes certos",
                "Chutes errados",
                "Nota",
            ]
        ]);

        Judgment::create([
            "item_id" => 2,
            "aspect" => "Julgamento",
            "scores" => [
                "Chutes feitos",
                "Chutes certos",
                "Chutes errados",
                "Nota",
            ]
        ]);

        Judgment::create([
            "item_id" => 3,
            "aspect" => "Julgamento",
            "scores" => [
                "Chutes feitos",
                "Chutes certos",
                "Chutes errados",
                "Nota"
            ]
        ]);

        Judgment::create([
            "item_id" => 4,
            "aspect" => "Mensurável",
            "scores" => [
                "Nota"
            ]
        ]);
    }
}
