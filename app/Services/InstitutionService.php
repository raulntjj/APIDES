<?php

namespace App\Services;

use App\Http\Requests\InstitutionRequest;
use App\Models\Institution;
use Exception;
use Illuminate\Support\Facades\DB;

class InstitutionService{
    //Função privada utilizada para encontrar as instituições ao logo do serviço
    private function findInstitution(int $id){
        //Busca e retorna a instituição
        return Institution::findOrFail($id);
    }

    //Função pública utilizada para retornar todas as instituições
    public function getInstitutions(){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () {
                //Retornando todas instituições e o código de respostas
                return response()->json(Institution::all(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all institutions', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar uma instituição
    public function getInstitution(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornanda instituição encontrado com suas informações de endereço e o código de respostas
                return response()->json($this->findInstitution($id), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get institution', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar uma instituição
    public function addInstitution(InstitutionRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Crianda instituição
                $institution = Institution::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'name',
                    'logo'
                ));

                //Retornanda instituição criado com suas informações de endereço e o código de respostas
                return response()->json($institution, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get institution', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar uma instituição
    public function updateInstitution(InstitutionRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando a instituição
                $institution = $this->findInstitution($id);

                //Atualizando dados da instituição e salvando utilizando o método fill
                $institution->fill($request->only(
                    //Explicitando váriaveis
                    'name',
                    'logo'
                ))->save();

                //Retornanda instituição atualizado com suas informações de endereço e o código de respostas
                return response()->json($institution, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get institution', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir uma instituição
    public function deleteInstitution(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando a instituição
                $institution = $this->findInstitution($id);
                //Deletanda instituição
                $institution->delete();

                //retornando resposta json
                return response()->json(["Institution deleted"], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete institution', 'Details' => $e->getMessage()], 404);
        }
    }
}
