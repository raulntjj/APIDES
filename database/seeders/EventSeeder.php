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
            "name" => "Campeonato Brasileiro de Botão",
            "dateTime" => "2024-04-11T15:00:00-03:00",
            "eventLogo" => "path/logo.png",
        ]);

        Event::create([
            "name" => "Torneio Internacional de Xadrez",
            "dateTime" => "2024-05-20T10:30:00-03:00",
            "eventLogo" => "path/chess_logo.png",
        ]);

        Event::create([
            "name" => "Conferência de Tecnologia",
            "dateTime" => "2024-07-05T09:00:00-03:00",
            "eventLogo" => "path/tech_conference_logo.png",
        ]);

        Event::create([
            "name" => "Exposição de Arte Contemporânea",
            "dateTime" => "2024-06-15T13:00:00-03:00",
            "eventLogo" => "path/art_exhibition_logo.png",
        ]);

        Event::create([
            "name" => "Concerto de Música Clássica",
            "dateTime" => "2024-08-08T19:30:00-03:00",
            "eventLogo" => "path/classical_music_concert_logo.png",
        ]);
    }
}
