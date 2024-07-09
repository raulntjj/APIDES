<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Participant;
use App\Models\Achievement;

class ParticipantSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Participant::create([
            "team_id" => 1,
            "user_id" => 1,
            "institution_id" => 1,
            "modality_id" => 1,
            "name" => "Raul",
            "lastName" => "De Oliveira",
            "gender" => "Male",
            "position" => "Pivô",
            "photo" => "path/perfil.jpg",
            "birthday" => "2000-01-01",
        ]);

        Achievement::create([
            "participant_id" => 1,
            "name" => "MVP"
        ]);

        Participant::create([
            "team_id" => 2,
            "user_id" => 2,
            "institution_id" => 2,
            "modality_id" => 2,
            "name" => "Ana",
            "lastName" => "Silva",
            "gender" => "Female",
            "position" => "Defensora",
            "photo" => "path/ana.jpg",
            "birthday" => "2000-01-01",
        ]);

        Achievement::create([
            "participant_id" => 2,
            "name" => "MVP"
        ]);

        Participant::create([
            "team_id" => 3,
            "user_id" => 3,
            "institution_id" => 3,
            "modality_id" => 3,
            "name" => "Lucas",
            "lastName" => "Santos",
            "gender" => "Male",
            "position" => "Atacante",
            "photo" => "path/lucas.jpg",
            "birthday" => "2000-01-01",
        ]);

        Achievement::create([
            "participant_id" => 3,
            "name" => "MVP"
        ]);

        Participant::create([
            "team_id" => 4,
            "user_id" => 4,
            "institution_id" => 4,
            "modality_id" => 4,
            "name" => "Carla",
            "lastName" => "Oliveira",
            "gender" => "Female",
            "position" => "Meio-campista",
            "photo" => "path/carla.jpg",
            "birthday" => "2000-01-01",
        ]);

        Achievement::create([
            "participant_id" => 4,
            "name" => "MVP"
        ]);

        Participant::create([
            "team_id" => 5,
            "user_id" => 5,
            "institution_id" => 5,
            "modality_id" => 5,
            "name" => "Pedro",
            "lastName" => "Sousa",
            "gender" => "Male",
            "position" => "Goleiro",
            "photo" => "path/pedro.jpg",
            "birthday" => "2000-01-01",
        ]);

        Achievement::create([
            "participant_id" => 5,
            "name" => "MVP"
        ]);
    }
}
