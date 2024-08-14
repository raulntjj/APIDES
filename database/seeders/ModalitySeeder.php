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
            "name" => "Futebol"
        ]);

        Modality::create([
            "name" => "Futsal"
        ]);

        Modality::create([
            "name" => "Fut7"
        ]);

        Modality::create([
            "name" => "Fut5"
        ]);

        Modality::create([
            "name" => "Atletismo"
        ]);
    }
}
