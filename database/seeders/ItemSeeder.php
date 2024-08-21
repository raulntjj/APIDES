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
            "sub_criterion_id" => 1,
            "name" => "Salto Vertical",
            "aspect" => "measurable",
        ]);

        Item::create([
            "sub_criterion_id" => 1,
            "name" => "Altura",
            "aspect" => "measurable",
        ]);

        Item::create([
            "sub_criterion_id" => 1,
            "name" => "Peso",
            "aspect" => "measurable",
        ]);

        Item::create([
            "sub_criterion_id" => 1,
            "name" => "Teste de 1000 metros",
            "aspect" => "measurable",
        ]);

        Item::create([
            "sub_criterion_id" => 1,
            "name" => "Peso",
            "aspect" => "measurable",
        ]);

        Item::create([
            "sub_criterion_id" => 2,
            "name" => "Illinois Agility C/B",
            "aspect" => "measurable",
        ]);

        Item::create([
            "sub_criterion_id" => 2,
            "name" => "Illinois Agility S/B",
            "aspect" => "measurable",
        ]);

        Item::create([
            "sub_criterion_id" => 2,
            "name" => "Embaixadinhas",
            "aspect" => "measurable",
        ]);

        Item::create([
            "sub_criterion_id" => 2,
            "name" => "Passe D",
            "aspect" => "quantitative",
        ]);

        Item::create([
            "sub_criterion_id" => 2,
            "name" => "Passe E",
            "aspect" => "quantitative",
        ]);
    }
}
