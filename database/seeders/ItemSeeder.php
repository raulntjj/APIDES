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
            "name" => "Physic",
            "score" => 100,
            "aspect" => "Mensurável"
        ]);

        Item::create([
            "name" => "Creativity",
            "score" => 90,
            "aspect" => "Mensurável"
        ]);

        Item::create([
            "name" => "Communication",
            "score" => 95,
            "aspect" => "Mensurável"
        ]);

        Item::create([
            "name" => "Teamwork",
            "score" => 85,
            "aspect" => "Mensurável"
        ]);

        Item::create([
            "name" => "Problem-solving",
            "score" => 80,
            "aspect" => "Mensurável"
        ]);
    }
}
