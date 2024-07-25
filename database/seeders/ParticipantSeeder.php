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


        for ($i = 1; $i <= 5; $i++) {
            $position = $positions[$i % count($positions)];

            Participant::create([
                "user_id" => $i,
                "team_id" => $i,
                "institution_id" => $i,
                "modality_id" => $i,
            ]);

            Achievement::create([
                "user_id" => $i,
                "name" => "MVP"
            ]);
        }
    }
}
