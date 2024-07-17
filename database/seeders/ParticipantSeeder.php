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
        $positions = [
            'ST',
            'SA',
            'LF',
            'RF',
            'LW',
            'RW',
            'CAM',
            'LM',
            'RM',
            'CM',
            'CDM',
            'LWB',
            'RWB',
            'CB',
            'GK',
            'F',
            'L',
            'R',
            'S',
            'G',
        ];

        $firstNames = ['Lucas', 'Pedro', 'Tiago', 'João', 'Ana', 'Maria', 'Carla', 'Raquel'];
        $lastNames = ['Silva', 'Santos', 'Oliveira', 'Souza', 'Costa', 'Pereira', 'Rodrigues', 'Almeida'];

        for ($i = 1; $i <= 30; $i++) {
            $team_id = ($i % 5) + 1;
            $user_id = ($i % 5) + 1;
            $institution_id = ($i % 5) + 1;
            $modality_id = ($i % 5) + 1;

            $position = $positions[$i % count($positions)];

            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];

            Participant::create([
                "team_id" => $team_id,
                "user_id" => $user_id,
                "institution_id" => $institution_id,
                "modality_id" => $modality_id,
                "name" => $firstName,
                "lastName" => $lastName,
                "gender" => ($i % 2 == 0) ? "Male" : "Female",
                "position" => $position,
                "photo" => "path/participant" . $i . ".jpg",
                "birthday" => "2000-01-01",
            ]);

            Achievement::create([
                "participant_id" => $i,
                "name" => "MVP"
            ]);
        }
    }
}
