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
            "logo" => "path/logo.png",
        ]);

        Event::create([
            "name" => "Torneio Internacional de Xadrez",
            "logo" => "path/chess_logo.png",
        ]);

        Event::create([
            "name" => "Conferência de Tecnologia",
            "logo" => "path/tech_conference_logo.png",
        ]);

        Event::create([
            "name" => "Exposição de Arte Contemporânea",
            "logo" => "path/art_exhibition_logo.png",
        ]);

        Event::create([
            "name" => "Concerto de Música Clássica",
            "logo" => "path/classical_music_concert_logo.png",
        ]);
    }
}
