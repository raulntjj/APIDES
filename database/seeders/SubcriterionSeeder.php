<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcriterion;

class SubcriterionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Subcriterion::create([
            "criterion_id" => 1,
            "name" => "Finalização",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 1,
            "name" => "Passes",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 1,
            "name" => "Controle de bola",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 1,
            "name" => "Dribles",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 1,
            "name" => "Interceptação",
            "points" => 20
        ]);


        Subcriterion::create([
            "criterion_id" => 2,
            "name" => "Foco",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 2,
            "name" => "Confiança",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 2,
            "name" => "Resiliência",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 2,
            "name" => "Respeito",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 2,
            "name" => "Humildade",
            "points" => 20
        ]);


        Subcriterion::create([
            "criterion_id" => 3,
            "name" => "Condição física",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 3,
            "name" => "Velocidade",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 3,
            "name" => "Força",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 3,
            "name" => "Mobilidade",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 3,
            "name" => "Equilíbrio",
            "points" => 20
        ]);


        Subcriterion::create([
            "criterion_id" => 4,
            "name" => "Leitura de jogo",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 4,
            "name" => "Tomada de decição",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 4,
            "name" => "Versatilidade",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 4,
            "name" => "Comunicação",
            "points" => 20
        ]);

        Subcriterion::create([
            "criterion_id" => 4,
            "name" => "Recuperação de bola",
            "points" => 20
        ]);
    }
}
