<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Participant;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Participant::create([
            "team_id" => 1,
            "institution_id" => 1,
            "modality_id" => 1,
            "firstName" => "Raul",
            "lastName" => "De Oliveira",
            "gender" => "Male",
            "position" => "Pivô",
            "photo" => "path/perfil.jpg"
        ]);

        Participant::create([
            "team_id" => 2,
            "institution_id" => 2,
            "modality_id" => 2,
            "firstName" => "Ana",
            "lastName" => "Silva",
            "gender" => "Female",
            "position" => "Defensora",
            "photo" => "path/ana.jpg"
        ]);

        Participant::create([
            "team_id" => 3,
            "institution_id" => 3,
            "modality_id" => 3,
            "firstName" => "Lucas",
            "lastName" => "Santos",
            "gender" => "Male",
            "position" => "Atacante",
            "photo" => "path/lucas.jpg"
        ]);

        Participant::create([
            "team_id" => 4,
            "institution_id" => 4,
            "modality_id" => 4,
            "firstName" => "Carla",
            "lastName" => "Oliveira",
            "gender" => "Female",
            "position" => "Meio-campista",
            "photo" => "path/carla.jpg"
        ]);

        Participant::create([
            "team_id" => 5,
            "institution_id" => 5,
            "modality_id" => 5,
            "firstName" => "Pedro",
            "lastName" => "Sousa",
            "gender" => "Male",
            "position" => "Goleiro",
            "photo" => "path/pedro.jpg"
        ]);
    }
}
