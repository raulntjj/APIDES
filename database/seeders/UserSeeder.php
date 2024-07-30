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
            'email' => 'admin@teste.com',
            'password' => '12345678',
            'role' => 'default',
            'isAdmin' => true,
            'interfaceLanguage' => 'PT-BR'
        ]);

        User::create([
            'name' => 'avaliador',
            'lastname' => 'avaliador',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'avaliador@teste.com',
            'password' => '12345678',
            'role' => 'evaluator',
            'interfaceLanguage' => 'PT-BR'
        ]);

        User::create([
            'name' => 'participant',
            'lastname' => 'participant',
            'gender' => 'female',
            'birthday' => '2000-01-01',
            'email' => 'participante@teste.com',
            'password' => '12345678',
            'role' => 'participant',
            'interfaceLanguage' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Ricardo',
            'lastname' => 'Silva',
            'gender' => 'other',
            'birthday' => '2000-01-01',
            'email' => 'ricardo@teste.com',
            'password' => '12345678',
            'role' => 'participant',
            'interfaceLanguage' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Camila',
            'lastname' => 'Silva',
            'gender' => 'female',
            'birthday' => '2000-01-01',
            'email' => 'camila@teste.com',
            'password' => '12345678',
            'role' => 'participant',
            'interfaceLanguage' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Pedro',
            'lastname' => 'Silva',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'pedro@teste.com',
            'password' => '12345678',
            'role' => 'Default',
            'interfaceLanguage' => 'PT-BR'
        ]);
    }
}
