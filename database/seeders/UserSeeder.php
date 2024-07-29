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
            'gender' => 'Male',
            'birthday' => '2000-01-01',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'role' => 'Avaliador',
            'interfaceLanguage' => 'PT-BR',
            'photo' => 'path/perfil.jpg'
        ]);

        User::create([
            'name' => 'Glauco',
            'lastname' => 'Silva',
            'gender' => 'Male',
            'birthday' => '2000-01-01',
            'email' => 'glauco@gmail.com',
            'password' => '12345678',
            'role' => 'Avaliador',
            'interfaceLanguage' => 'PT-BR',
            'photo' => 'path/perfil.jpg'
        ]);

        User::create([
            'name' => 'Joana',
            'lastname' => 'Silva',
            'gender' => 'Female',
            'birthday' => '2000-01-01',
            'email' => 'joana@example.com',
            'password' => 'senha123',
            'role' => 'Usuário',
            'interfaceLanguage' => 'EN',
            'photo' => 'path/joana.jpg'
        ]);

        User::create([
            'name' => 'Ricardo',
            'lastname' => 'Silva',
            'gender' => 'Male',
            'birthday' => '2000-01-01',
            'email' => 'ricardo@hotmail.com',
            'password' => 'senha1234',
            'role' => 'Administrador',
            'interfaceLanguage' => 'ES',
            'photo' => 'path/ricardo.jpg'
        ]);

        User::create([
            'name' => 'Camila',
            'lastname' => 'Silva',
            'gender' => 'Female',
            'birthday' => '2000-01-01',
            'email' => 'camila@example.com',
            'password' => 'senha12345',
            'role' => 'Moderador',
            'interfaceLanguage' => 'PT-BR',
            'photo' => 'path/camila.jpg'
        ]);

        User::create([
            'name' => 'Pedro',
            'lastname' => 'Silva',
            'gender' => 'Male',
            'birthday' => '2000-01-01',
            'email' => 'pedro@example.com',
            'password' => 'senha123456',
            'role' => 'Cliente',
            'interfaceLanguage' => 'PT-BR',
            'photo' => 'path/pedro.jpg'
        ]);
    }
}
