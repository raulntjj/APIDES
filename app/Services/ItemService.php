<?php

namespace App\Services;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class ItemService{
    //Função privada utilizada para encontrar os itenss ao longo do serviço
    private function findItem(int $id){
        //Busca e retorna o itens
        return Item::with('subcriterion.criterion')->orderBy('name')->findOrFail($id);
    }

    //Função pública utilizada para retornar todos os itenss
    public function getItems(Request $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request) {
                $items = Item::with('subcriterion.criterion')->orderBy('name');
                if ($request->has('search')) {
                    $search = $request->search;

                    $items->where(function ($query) use ($search) {
                        $query->whereHas('subcriterion.criterion', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('subcriterion', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhere('aspect', 'like', '%' . $search . '%');
                    });
                }

                // if($request->get('getAll', false)){
                //     return $items->get();
                // }
                // $page = $request->get('page', 1);
                // $perPage = $request->get('perPage', 10);
                // return $items->paginate($perPage, ['*'], 'page', $page);
                //Retornando todos itenss e o código de respostas
                return response()->json($items->get(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all Items', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um itens
    public function getItem(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando itens encontrado com suas informações de endereço e o código de respostas
                return response()->json($this->findItem($id), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Item', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um itens
    public function addItem(ItemRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Criando itens
                $item = Item::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'sub_criterion_id',
                    'name',
                    'aspect',
                    'weight',
                ));

                //Retornando itens criado com suas informações de endereço e o código de respostas
                return response()->json($item, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add Item', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um itens
    public function updateItem(ItemRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando o itens
                $item = $this->findItem($id);

                //Atualizando dados do itens e salvando utilizando o método fill
                $item->fill($request->only(
                    //Explicitando váriaveis
                    'sub_criterion_id',
                    'name',
                    'aspect',
                    'weight',
                ))->save();

                //Retornando itens atualizado com suas informações de endereço e o código de respostas
                return response()->json($item, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update Item', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um itens
    public function deleteItem(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando o itens
                $item = $this->findItem($id);
                //Deletando itens
                $item->delete();
                //retornando resposta json
                return response()->json(['Success' => 'Item deleted'], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Item', 'Details' => $e->getMessage()], 404);
        }
    }
}
