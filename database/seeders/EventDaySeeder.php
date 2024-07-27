<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventDay;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        EventDay::create([
            "event_id" => "1",
            "date" => "2024-04-11",
            "startHour" => "20:00:00",
            "index" => "1"
        ]);

        EventDay::create([
            "event_id" => "2",
            "date" => "2024-05-20",
            "startHour" => "20:00:00",
            "index" => "1"
        ]);

        EventDay::create([
            "event_id" => "3",
            "date" => "2024-07-05",
            "startHour" => "20:00:00",
            "index" => "1"
        ]);

        EventDay::create([
            "event_id" => "4",
            "date" => "2024-06-15",
            "startHour" => "20:00:00",
            "index" => "1"
        ]);

        EventDay::create([
            "event_id" => "5",
            "date" => "2024-08-08",
            "startHour" => "20:00:00",
            "index" => "1"
        ]);
    }
}
