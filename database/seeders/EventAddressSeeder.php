<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventAddress;

class EventAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        EventAddress::create([
            "event_id" => "1",
            "address" => "Av. Antônio Abrahão Caram",
            "number" => "1001",
            "neighborhood" => "Pampulha",
            "city" => "Belo Horizonte",
            "state" => "Minas Gerais",
            "country" => "Brasil",
            "cep" => "31275-000",
        ]);

        EventAddress::create([
            "event_id" => "2",
            "address" => "Rua das Flores",
            "number" => "500",
            "neighborhood" => "Centro",
            "city" => "São Paulo",
            "state" => "São Paulo",
            "country" => "Brasil",
            "cep" => "01001-000",
        ]);

        EventAddress::create([
            "event_id" => "3",
            "address" => "Avenida Atlântica",
            "number" => "1500",
            "neighborhood" => "Copacabana",
            "city" => "Rio de Janeiro",
            "state" => "Rio de Janeiro",
            "country" => "Brasil",
            "cep" => "22021-000",
        ]);

        EventAddress::create([
            "event_id" => "4",
            "address" => "Praça da Sé",
            "number" => "1",
            "neighborhood" => "Sé",
            "city" => "São Paulo",
            "state" => "São Paulo",
            "country" => "Brasil",
            "cep" => "01001-001",
        ]);

        EventAddress::create([
            "event_id" => "5",
            "address" => "Avenida Paulista",
            "number" => "1000",
            "neighborhood" => "Bela Vista",
            "city" => "São Paulo",
            "state" => "São Paulo",
            "country" => "Brasil",
            "cep" => "01310-100",
        ]);

        EventAddress::create([
            "event_id" => "6",
            "address" => "Avenida Paulista",
            "number" => "1000",
            "neighborhood" => "Bela Vista",
            "city" => "São Paulo",
            "state" => "São Paulo",
            "country" => "Brasil",
            "cep" => "01310-100",
        ]);

        EventAddress::create([
            "event_id" => "7",
            "address" => "Avenida Paulista",
            "number" => "1000",
            "neighborhood" => "Bela Vista",
            "city" => "São Paulo",
            "state" => "São Paulo",
            "country" => "Brasil",
            "cep" => "01310-100",
        ]);

        EventAddress::create([
            "event_id" => "8",
            "address" => "Avenida Paulista",
            "number" => "1000",
            "neighborhood" => "Bela Vista",
            "city" => "São Paulo",
            "state" => "São Paulo",
            "country" => "Brasil",
            "cep" => "01310-100",
        ]);
    }
}
