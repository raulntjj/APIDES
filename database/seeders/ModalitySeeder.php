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
            "name" => "Futsal"
        ]);

        Modality::create([
            "name" => "Natação"
        ]);

        Modality::create([
            "name" => "Vôlei"
        ]);

        Modality::create([
            "name" => "Judô"
        ]);

        Modality::create([
            "name" => "Atletismo"
        ]);
    }
}
