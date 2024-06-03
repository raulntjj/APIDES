<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        "Para acessar a documentação da API basta apenas digitar o sufixo '/api/documentation' após seu host ou loopback da máquina",
        'Exemplo: http://127.0.0.1:8000/api/documentation',
        "Lembre-se de executar o comando 'php artisan migrate' para criar o banco de dados na máquina e o comando 'php artisan db:seed' para criar uma seed de dados (opcional)",
        'Laravel' => app()->version()
    ];
});

require __DIR__.'/auth.php';
