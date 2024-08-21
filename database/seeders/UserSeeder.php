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
            'last_name' => 'Admin',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'admin@teste.com',
            'password' => '12345678',
            'role' => 'admin',
            'is_admin' => true,
            'interface_language' => 'PT-BR'
        ]);

        User::create([
            'name' => 'avaliador',
            'last_name' => 'avaliador',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'avaliador@teste.com',
            'password' => '12345678',
            'role' => 'judge',
            'interface_language' => 'PT-BR'
        ]);

        User::create([
            'name' => 'participant',
            'last_name' => 'participant',
            'gender' => 'female',
            'birthday' => '2000-01-01',
            'email' => 'participante@teste.com',
            'password' => '12345678',
            'role' => 'participant',
            'interface_language' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Ricardo',
            'last_name' => 'Silva',
            'gender' => 'other',
            'birthday' => '2000-01-01',
            'email' => 'ricardo@teste.com',
            'password' => '12345678',
            'role' => 'participant',
            'interface_language' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Camila',
            'last_name' => 'Silva',
            'gender' => 'female',
            'birthday' => '2000-01-01',
            'email' => 'camila@teste.com',
            'password' => '12345678',
            'role' => 'participant',
            'interface_language' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Pedro',
            'last_name' => 'Silva',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'pedro@teste.com',
            'password' => '12345678',
            'role' => 'participant',
            'interface_language' => 'PT-BR'
        ]);
    }
}
