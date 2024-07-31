<?php

namespace App\Http\Controllers;

class Controller{
    public function downloadCollection(){
        // Caminho do arquivo JSON na raiz do projeto
        $filePath = base_path('API Desempenho esportivo.postman_collection.json'); // Certifique-se de que o nome do arquivo e a extensão estão corretos

        // Verificando se o arquivo existe
        if (!file_exists($filePath)) {
            abort(404, 'Arquivo não encontrado.');
        }

        // Retornando o arquivo como download
        return response()->download($filePath, 'Collection API.json', [
            'Content-Type' => 'application/json',
        ]);
    }
}
