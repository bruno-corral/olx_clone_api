<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStateRequest;
use App\Models\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    public $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function index() : JsonResponse
    {
        $states = $this->state->all();

        return response()->json(['states' => $states]);
    }

    public function findOne(Request $request): JsonResponse
    {
        $state = $this->state->find($request->id);

        if (!$state) {
            return response()->json(['message' => 'O estado não foi encontrado pois não existe um estado com id '.$request->id.'!']);
        }

        return response()->json(['state' => $state]);
    }

    public function create(CreateStateRequest $request): JsonResponse
    {
        $data = $request->only(['name', 'slug']);

        $state = $this->state->create($data);

        $response = [
            'error' => '',
            'state' => $state
        ];

        return response()->json(['data' => $response]);
    }

    public function update(CreateStateRequest $request): JsonResponse
    {
        $data = $request->only(['name', 'slug']);

        $state = $this->state->find($request->id);

        if (!$state) {
            return response()->json(['message' => 'O estado com o id '.$request->id.' não foi encontrado!']);
        }

        $state->update($data);
        $state->save();

        $response = [
            'error' => '',
            'message' => 'O estado foi atualizado com sucesso!',
            'state' => $state
        ];

        return response()->json(['data' => $response]);
    }

    public function delete(Request $request): JsonResponse
    {
        $state = $this->state->find($request->id);

        if (!$state) {
            return response()->json(['message' => 'O estado não foi deletado pois o estado com id '.$request->id.' não foi encontrado!']);
        }

        $state->delete();

        $response = [
            'error' => '',
            'message' => 'O estado com o id '.$request->id.' foi deletado com sucesso!'
        ];

        return response()->json(['data' => $response]);
    }

    public function restore(Request $request)
    {
        $state = $this->state->withTrashed()->find($request->id);

        if (!$state) {
            return response()->json(['message' => 'O estado com o id '.$request->id.' não foi restaurado pois o id não foi encontrado!']);
        }

        $state->restore();

        $response = [
            'error' => '',
            'message' => 'O estado com o id '.$request->id.' foi restaurado com sucesso!'
        ];

        return response()->json(['data' => $response]);
    }
}
