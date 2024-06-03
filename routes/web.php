<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        'Para acessar a documentação navege por host/api/documentation',
        'Exemplo: http://127.0.0.1:8000/api/documentation',
        'Para uso de teste, utilize localhost ou o endereço de loopback da sua máquina',
        'Laravel' => app()->version()
    ];
});

require __DIR__.'/auth.php';
