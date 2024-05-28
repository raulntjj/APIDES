<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modality;

class ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Modality::create([
            "name" => "Futsal",
            "type" => "Esporte coletivo"
        ]);

        Modality::create([
            "name" => "Natação",
            "type" => "Esporte individual"
        ]);

        Modality::create([
            "name" => "Vôlei",
            "type" => "Esporte coletivo"
        ]);

        Modality::create([
            "name" => "Judô",
            "type" => "Arte marcial"
        ]);

        Modality::create([
            "name" => "Atletismo",
            "type" => "Esporte individual"
        ]);
    }
}
