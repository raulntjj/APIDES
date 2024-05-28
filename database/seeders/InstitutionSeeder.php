<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Institution::create([
            "name" => "JEMG",
            "logo" => "path/logo.png"
        ]);

        Institution::create([
            "name" => "IFMG",
            "logo" => "path/ifmg_logo.png"
        ]);

        Institution::create([
            "name" => "UFMG",
            "logo" => "path/ufmg_logo.png"
        ]);

        Institution::create([
            "name" => "UNESP",
            "logo" => "path/unesp_logo.png"
        ]);

        Institution::create([
            "name" => "UNICAMP",
            "logo" => "path/unicamp_logo.png"
        ]);
    }
}
