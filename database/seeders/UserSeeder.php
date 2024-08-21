<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        User::create([
            'name' => 'Participante 1',
            'last_name' => 'Sobrenome 1',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'participante1@teste.com',
            'password' => '12345678',
            'role' => 'participant',
            'interface_language' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Participante 2',
            'last_name' => 'Sobrenome 2',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'participante2@teste.com',
            'password' => '12345678',
            'role' => 'participant',
            'interface_language' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Participante 3',
            'last_name' => 'Sobrenome 3',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'participante3@teste.com',
            'password' => '12345678',
            'role' => 'participant',
            'interface_language' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Participante 4',
            'last_name' => 'Sobrenome 4',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'participante4@teste.com',
            'password' => '12345678',
            'role' => 'participant',
            'interface_language' => 'PT-BR'
        ]);

        User::create([
            'name' => 'Participante 5',
            'last_name' => 'Sobrenome 5',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'participante5@teste.com',
            'password' => '12345678',
            'role' => 'participant',
            'interface_language' => 'PT-BR'
        ]);


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
            'name' => 'avaliador1',
            'last_name' => 'avaliador1',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'avaliador1@teste.com',
            'password' => '12345678',
            'role' => 'judge',
            'interface_language' => 'PT-BR'
        ]);

        User::create([
            'name' => 'avaliador2',
            'last_name' => 'avaliador2',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'avaliador2@teste.com',
            'password' => '12345678',
            'role' => 'judge',
            'interface_language' => 'PT-BR'
        ]);

        User::create([
            'name' => 'avaliador3',
            'last_name' => 'avaliador3',
            'gender' => 'male',
            'birthday' => '2000-01-01',
            'email' => 'avaliador3@teste.com',
            'password' => '12345678',
            'role' => 'judge',
            'interface_language' => 'PT-BR'
        ]);
    }
}
