<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        User::create([
            'name' => 'Admin',
            'lastname' => 'Admin',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'role' => 'evaluator',
            'isAdmin' => true,
            'interfaceLanguage' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Glauco',
            'lastname' => 'Silva',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'glauco@example.com',
            'password' => '12345678',
            'role' => 'participant',
            'interfaceLanguage' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Joana',
            'lastname' => 'Silva',
            'gender' => 'female',
            'birthday' => '2000-01-01',
            'email' => 'joana@example.com',
            'password' => '12345678',
            'role' => 'participant',
            'interfaceLanguage' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Ricardo',
            'lastname' => 'Silva',
            'gender' => 'other',
            'birthday' => '2000-01-01',
            'email' => 'ricardo@example.com',
            'password' => '12345678',
            'role' => 'participant',
            'interfaceLanguage' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Camila',
            'lastname' => 'Silva',
            'gender' => 'female',
            'birthday' => '2000-01-01',
            'email' => 'camila@example.com',
            'password' => '12345678',
            'role' => 'participant',
            'interfaceLanguage' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Pedro',
            'lastname' => 'Silva',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'pedro@example.com',
            'password' => '12345678',
            'role' => 'Default',
            'interfaceLanguage' => 'PT-BR'
        ]);
    }
}
