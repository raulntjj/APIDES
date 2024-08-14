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
            "name" => "Cruzeiro",
            "logo" => "path/logo.png"
        ]);

        Team::create([
            "name" => "Flamengo",
            "logo" => "path/flamengo_logo.png"
        ]);

        Team::create([
            "name" => "Palmeiras",
            "logo" => "path/palmeiras_logo.png"
        ]);

        Team::create([
            "name" => "São Paulo",
            "logo" => "path/sao_paulo_logo.png"
        ]);

        Team::create([
            "name" => "Corinthians",
            "logo" => "path/corinthians_logo.png"
        ]);
    }
}
