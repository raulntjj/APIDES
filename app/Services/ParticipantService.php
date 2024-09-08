<?php

namespace App\Services;

use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Exception;
use Illuminate\Support\Facades\DB;

class ParticipantService{
    //Função privada utilizada para encontrar os participantes ao longo do serviço
    private function findParticipant(int $id){
        //Busca e retorna o participante}
        return Participant::orderBy('user_id')->findOrFail($id);
    }

    public function getParticipants(Request $request) {
        try {
            // Inicia a consulta com os relacionamentos necessários
            $participants = Participant::with('team', 'institution', 'modality', 'user', 'achievements');

            // Filtro de busca
            if ($request->has('search')) {
                $participants->where(function ($query) use ($request) {
                    $query->whereHas('user', function($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%')
                            ->orWhere('birthday', 'like', '%' . $request->search . '%')
                            ->orWhere('last_name', 'like', '%' . $request->search . '%')
                            ->orWhere('gender', 'like', '%' . $request->search . '%');
                    });
                });
            }

            // Filtros adicionais
            if ($request->has('team_id')) {
                $participants->where('team_id', $request->team_id);
            }
            if ($request->has('institution_id')) {
                $participants->where('institution_id', $request->institution_id);
            }
            if ($request->has('modality_id')) {
                $participants->where('modality_id', $request->modality_id);
            }
            if ($request->has('position')) {
                $participants->where('position', $request->position);
            }

            // Definindo o número de itens por página
            $perPage = $request->get('perPage', 10);
            $page = $request->get('page', 1);
            $path = $request->url(); // URL base da requisição

            // Se 'groupBySub' for ativado, faz a paginação por categoria (ex: sub-17)
            if ($request->get('groupBySub', false)) {
                // Busca os participantes e os agrupa por 'category'
                $participantsGrouped = $participants->get()->groupBy('category');

                // Se um subgrupo específico for solicitado
                $subCategory = $request->get('sub', 'all');

                if ($subCategory === 'all') {
                    return $participantsGrouped;
                } else {
                    // Paginando o subgrupo selecionado
                    $selectedSubCategory = $participantsGrouped->get($subCategory);

                    if ($selectedSubCategory) {
                        // Pagina o subgrupo selecionado
                        $total = $selectedSubCategory->count();
                        $paginatedSubCategory = $selectedSubCategory->forPage($page, $perPage);

                        // Calcula URLs para paginação
                        $first_page_url = $path . '?' . http_build_query(array_merge($request->except('page'), ['page' => 1]));
                        $last_page = ceil($total / $perPage);
                        $last_page_url = $path . '?' . http_build_query(array_merge($request->except('page'), ['page' => $last_page]));
                        $next_page_url = $page < $last_page ? $path . '?' . http_build_query(array_merge($request->except('page'), ['page' => $page + 1])) : null;
                        $prev_page_url = $page > 1 ? $path . '?' . http_build_query(array_merge($request->except('page'), ['page' => $page - 1])) : null;

                        // Geração dos links para paginação
                        $links = [
                            [
                                'url' => $prev_page_url,
                                'label' => '&laquo; Previous',
                                'active' => false,
                            ],
                            [
                                'url' => $path . '?' . http_build_query(array_merge($request->except('page'), ['page' => $page])),
                                'label' => (string) $page,
                                'active' => true,
                            ],
                            [
                                'url' => $next_page_url,
                                'label' => 'Next &raquo;',
                                'active' => false,
                            ]
                        ];

                        // Retorna o resultado paginado com os metadados de paginação
                        return response()->json([
                            'data' => $paginatedSubCategory->values(),
                            'current_page' => $page,
                            'per_page' => $perPage,
                            'total' => $total,
                            'first_page_url' => $first_page_url,
                            'from' => ($page - 1) * $perPage + 1,
                            'last_page' => $last_page,
                            'last_page_url' => $last_page_url,
                            'links' => $links,
                            'next_page_url' => $next_page_url,
                            'path' => $path,
                            'prev_page_url' => $prev_page_url,
                            'to' => min($page * $perPage, $total),
                        ]);
                    } else {
                        return response()->json(['error' => 'Subcategory not found'], 404);
                    }
                }
            } else {
                // Paginação normal sem agrupamento
                return $participants->paginate($perPage, ['*'], 'page', $page);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //Função pública utilizada para retornar todos os participantes
    public function getParticipantsBySub(Request $request){
        // Tratativa de erros
        try {
            // Inicia a consulta com os relacionamentos necessários
            $participants = Participant::with('team', 'institution', 'modality', 'user', 'achievements');

            // Filtro de busca
            if ($request->has('search')) {
                $participants->where(function ($query) use ($request) {
                    $query->whereHas('user', function($q) use ($request){
                        $q->where('name', 'like', '%' . $request->search . '%')
                        ->orwhere('birthday', 'like', '%' . $request->search . '%')
                        ->orWhere('last_name', 'like', '%' . $request->search . '%')
                        ->orWhere('gender', 'like', '%' . $request->search . '%')
                        ->orWhere('birthday', 'like', '%' . $request->search . '%');
                    });
                });
            }

            // Filtros adicionais
            if ($request->has('team_id')) {
                $participants->where('team_id', $request->team_id);
            }
            if ($request->has('institution_id')) {
                $participants->where('institution_id', $request->institution_id);
            }
            if ($request->has('modality_id')) {
                $participants->where('modality_id', $request->modality_id);
            }
            if ($request->has('position')) {
                $participants->where('position', $request->position);
            }

            // Agregando os resultados
            $participants = $participants->get()->groupBy('category');

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    //Função pública utilizada para retornar um participante
    public function getParticipant(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando participante encontrado com suas informações de endereço e o código de respostas
                $participant = $this->findParticipant($id);
                return response()->json([
                    $participant,
                    $participant->user,
                    $participant->team,
                    $participant->institution,
                    $participant->modality,
                    $participant->achievements
                ], 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Participant', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um participante
    public function addParticipant(StoreParticipantRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                $participant = Participant::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'user_id',
                    'team_id',
                    'institution_id',
                    'modality_id',
                    'position',
                ));

                //Retornando participante criado com suas informações de endereço e o código de respostas
                return response()->json($participant, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add Participant', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um participante
    public function updateParticipant(UpdateParticipantRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando o participante
                $participant = $this->findParticipant($id);

                //Atualizando dados do participante e salvando utilizando o método fill
                $participant->fill($request->only(
                    //Explicitando váriaveis
                    'user_id',
                    'team_id',
                    'institution_id',
                    'modality_id',
                    'position',
                ))->save();

                //Retornando participante atualizado com suas informações de endereço e o código de respostas
                return response()->json($participant, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update Participant', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um participante
    public function deleteParticipant(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando o participante
                $participant = $this->findParticipant($id);
                //Deletando participante
                $participant->delete();

                //retornando resposta json
                return response()->json(['Success' => 'Participant deleted'], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Participant', 'Details' => $e->getMessage()], 404);
        }
    }
}
