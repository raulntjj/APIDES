<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void{
        $this->call(UserSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(EventAddressSeeder::class);
        $this->call(EventDaySeeder::class);
        $this->call(InstitutionSeeder::class);
        $this->call(ModalitySeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(ParticipantSeeder::class);
        $this->call(CriterionSeeder::class);
        $this->call(SubcriterionSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(EvaluationSeeder::class);
        $this->call(JudgmentSeeder::class);
    }
}
