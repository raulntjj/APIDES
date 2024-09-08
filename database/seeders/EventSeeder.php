<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Event::create([
            "name" => "Campeonato de futsal de Caratinga",
            "logo" => "path/logo.png",
            "type" => "tournament"
        ]);

        Event::create([
            "name" => "Super Copa Perna de Pau",
            "logo" => "path/logo.png",
            "type" => "tournament"
        ]);

        Event::create([
            "name" => "Jogos Escolares de Minas Gerais",
            "logo" => "path/logo.png",
            "type" => "tournament"
        ]);

        Event::create([
            "name" => "Copa Caratinguense",
            "logo" => "path/logo.png",
            "type" => "tournament"
        ]);

        Event::create([
            "name" => "JEMG II",
            "logo" => "path/logo.png",
            "type" => "tournament"
        ]);

        Event::create([
            "name" => "Avaliação de Outubro",
            "logo" => "path/logo.png",
            "type" => "training"
        ]);

        Event::create([
            "name" => "Avaliação de Outubro",
            "logo" => "path/logo.png",
            "type" => "training"
        ]);

        Event::create([
            "name" => "Avaliação de Novembro",
            "logo" => "path/logo.png",
            "type" => "training"
        ]);
    }
}
