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
            "start_hour" => "20:00:00",
            "index" => "1"
        ]);

        EventDay::create([
            "event_id" => "2",
            "date" => "2024-05-20",
            "start_hour" => "20:00:00",
            "index" => "1"
        ]);

        EventDay::create([
            "event_id" => "3",
            "date" => "2024-07-05",
            "start_hour" => "20:00:00",
            "index" => "1"
        ]);

        EventDay::create([
            "event_id" => "4",
            "date" => "2024-06-15",
            "start_hour" => "20:00:00",
            "index" => "1"
        ]);

        EventDay::create([
            "event_id" => "5",
            "date" => "2024-10-08",
            "start_hour" => "08:00:00",
            "index" => "1"
        ]);

        EventDay::create([
            "event_id" => "6",
            "date" => "2024-09-20",
            "start_hour" => "18:00:00",
            "index" => "1"
        ]);

        EventDay::create([
            "event_id" => "7",
            "date" => "2024-10-20",
            "start_hour" => "16:00:00",
            "index" => "1"
        ]);

        EventDay::create([
            "event_id" => "8",
            "date" => "2024-11-20",
            "start_hour" => "19:00:00",
            "index" => "1"
        ]);
    }
}
