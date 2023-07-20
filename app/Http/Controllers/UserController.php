<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\SignInRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $user;

    public function __construct(User $user)
    {  
        $this->user = $user;
    } 

    public function index(): JsonResponse 
    {
        $users = $this->user->all();
        return response()->json(['users' => $users]);
    }

    public function findOne(Request $request): JsonResponse
    {
        $user = $this->user->find($request->id);

        if (!$user) {
            return response()->json(['message' => 'Não foi encontrado nenhum usuário com o id '.$request->id.'.']);
        }

        return response()->json(['user' => $user]);
    }

    public function signup(CreateUserRequest $request): JsonResponse
    {        
        $data = $request->only(['name', 'email', 'password', 'state_id']);
        $data['password'] = Hash::make($data['password']);

        $user = $this->user->create($data);

        $response = [
            'error' => '',
            'token' => $user->createToken('Register_token')->plainTextToken
        ];

        return response()->json([$response]);
    }

    public function signin(SignInRequest $request): JsonResponse
    {
        $data = $request->only(['email', 'password']);

        if (Auth::attempt($data)) {
            $user = Auth::user();

            $response = [
                'error' => '',
                'token' => $user->createToken('Login_token')->plainTextToken
            ];

            return response()->json($response);
        }

        return response()->json(['error' => 'Usuário e ou Senha Inválidos!']);
    }

    public function infos(): JsonResponse
    {
        $user = Auth::user();

        $response = [
            'name' => $user->name,
            'email' => $user->email,
            'state' => $user->state->name,
            'ads' => $user->advertises
        ];

        return response()->json($response);
    }

    public function update(CreateUserRequest $request): JsonResponse
    {
        $data = $request->only(['name', 'email', 'password', 'state_id']);
        $data['password'] = Hash::make($data['password']);

        $user = $this->user->find($request->id);

        if (!$user) {
            return response()->json(['message' => 'O usuário com o id '.$request->id.' não foi atualizado pois o id não foi encontrado!']);
        }

        $user->update($data);
        $user->save();

        $response = [
            'error' => '',
            'message' => 'O usuário com o id '.$request->id.' foi atualizado com sucesso!',
            'user' => $user
        ];

        return response()->json(['data' => $response]);
    }

    public function delete(Request $request): JsonResponse
    {   
        $user = $this->user->find($request->id);

        if (!$user) {
            return response()->json(['message' => 'O usuário com o id '.$request->id.' não foi deletado pois o id não foi encontrado!']);
        }

        $user->delete();

        $response = [
            'error' => '',
            'message' => 'O usuário com o id '.$request->id.' foi deletado com sucesso!',
            'user' => $user
        ];

        return response()->json(['data' => $response]);
    }

    public function restore(Request $request): JsonResponse
    {
        $user = $this->user->withTrashed()->find($request->id);

        if (!$user) {
            return response()->json(['message' => 'O usuário com o id '.$request->id.' não foi restaurado pois o id não foi encontrado']);
        }

        $user->restore();

        $response = [
            'error' => '',
            'message' => 'O usuário com o id '.$request->id.' foi restaurado com sucesso!'
        ];

        return response()->json(['data' => $response]);
    }
}
