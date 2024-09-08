<?php

namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserService{
    //Função privada utilizada para encontrar os usuários ao longo do serviço
    private function findUser(int $id){
        //Busca e retorna o usuário
        return User::with('participant', 'participant.team', 'participant.modality', 'participant.institution')->orderBy('name')->findOrFail($id);
    }

    //Função pública utilizada para retornar todos os usuários
    public function getUsers(Request $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request) {
                $users = User::with('participant', 'participant.team', 'participant.modality', 'participant.institution')->orderBy('name');
                if ($request->has('search')) {
                    $search = $request->search;

                    $users->where(function ($query) use ($search) {
                        $query->Where('name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('gender', 'like', '%' . $search . '%')
                        ->orWhere('birthday', 'like', '%' . $search . '%')
                        ->orWhere('role', 'like', '%' . $search . '%');
                    });
                }

                $page = $request->get('page', 1);
                $perPage = $request->get('perPage', 10);
                return $users->paginate($perPage, ['*'], 'page', $page);
                //Retornando todos times e o código de respostas
                // return response()->json($users->get(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all Users', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um usuário
    public function getUser(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando usuário encontrado com suas informações de endereço e o código de respostas
                return response()->json($this->findUser($id), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get User', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um usuário
    public function addUser(StoreUserRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Criando usuário
                $is_admin = $request->role === 'admin';
                $passwordHashed = Hash::make($request->password);
                $user = User::create([
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'birthday' => $request->birthday,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'role' => $request->role,
                    'interface_language' => $request->interface_language,
                    'photo' => $request->photo,
                    'password' => $passwordHashed,
                    'is_admin' => $is_admin
                ]);
                //Retornando usuário criado com suas informações de endereço e o código de respostas
                return response()->json($user, 201);
            });
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add User', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um usuário
    public function updateUser(UpdateUserRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando o usuário
                $user = $this->findUser($id);

                //Atualizando dados do usuário e salvando utilizando o método fill
                $user->fill($request->only(
                    //Explicitando váriaveis
                    'name',
                    'last_name',
                    'birthday',
                    'gender',
                    'email',
                    'photo'
                ))->save();

                //Retornando usuário atualizado com suas informações de endereço e o código de respostas
                return response()->json($user, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update User', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um usuário
    public function deleteUser(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando o usuário
                $user = $this->findUser($id);
                //Deletando usuário
                $user->delete();

                //retornando resposta json
                return response()->json(['Success' => 'User deleted'], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete User', 'Details' => $e->getMessage()], 404);
        }
    }

    public function getJudges(){
        return User::where('role', 'judge')->get();
    }

    public function getAdmins(){
        return User::where('is_admin', true)->get();
    }
}
