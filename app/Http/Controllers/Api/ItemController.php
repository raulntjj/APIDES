<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ItemRequest;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController{
    //Instanciando serviço
    protected $itemService;
    public function __construct(ItemService $itemService){
        $this->itemService = $itemService;
    }

    //Função para obter todos itens
    public function index(Request $request){
        return $this->itemService->getItems($request);
    }

    //Função para obter um item
    public function show(int $id){
        return $this->itemService->getItem($id);
    }

    //Função para criar um item
    public function store(ItemRequest $request){
        return $this->itemService->addItem($request);
    }

    //Função para editar um item
    public function update(ItemRequest $request, int $id){
        return $this->itemService->updateItem($request, $id);
    }

    //Função para excluir um item
    public function destroy(int $id){
        return $this->itemService->deleteItem($id);
    }
}
