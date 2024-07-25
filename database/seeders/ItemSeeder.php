<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Item::create([
            "subCriterion_id" => 1,
            "name" => "Chutes dentro da área",
        ]);

        Item::create([
            "subCriterion_id" => 1,
            "name" => "Chutes fora da área",
        ]);

        Item::create([
            "subCriterion_id" => 1,
            "name" => "Pênalti",
        ]);

        Item::create([
            "subCriterion_id" => 1,
            "name" => "Cabeçeio",
        ]);
    }
}
