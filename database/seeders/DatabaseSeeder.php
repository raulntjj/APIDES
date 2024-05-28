<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\EventSeeder;
use Database\Seeders\EventAddressSeeder;
use Database\Seeders\EventDaySeeder;
use Database\Seeders\InstitutionSeeder;
use Database\Seeders\ModalitySeeder;
use Database\Seeders\TeamSeeder;
use Database\Seeders\ParticipantSeeder;
use Database\Seeders\CriterionSeeder;
use Database\Seeders\SubCriterionSeeder;
use Database\Seeders\ItemSeeder;
use Database\Seeders\JugdmentSeeder;
use Database\Seeders\EvaluationSeeder;
use Database\Seeders\ScheduleSeeder;
use Database\Seeders\ScoreSeeder;

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
        $this->call(SubCriterionSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(JudgmentSeeder::class);
        $this->call(EvaluationSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(ScoreSeeder::class);
    }
}
