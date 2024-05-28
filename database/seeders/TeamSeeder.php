<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Team::create([
            "name" => "Cruzeiro do buracão",
            "logo" => "path/logo.png"
        ]);

        Team::create([
            "name" => "Flamengo da Serra",
            "logo" => "path/flamengo_logo.png"
        ]);

        Team::create([
            "name" => "Palmeiras da Praia",
            "logo" => "path/palmeiras_logo.png"
        ]);

        Team::create([
            "name" => "São Paulo da Montanha",
            "logo" => "path/sao_paulo_logo.png"
        ]);

        Team::create([
            "name" => "Corinthians do Campo",
            "logo" => "path/corinthians_logo.png"
        ]);
    }
}
