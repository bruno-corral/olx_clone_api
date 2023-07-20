<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdvertiseRequest;
use App\Models\Advertise;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    public $advertise;

    public function __construct(Advertise $advertise)
    {
        $this->advertise = $advertise;
    }

    /**
     * return JsonResponse array
     */
    public function index(): JsonResponse
    {
        $advertises = $this->advertise->all();

        return response()->json(['advertises' => $advertises]);
    }

    /**
     * @param Request $request string
     * 
     * return JsonResponse array
     */
    public function findOne(Request $request): JsonResponse
    {
        $advertise = $this->advertise->find($request->id);

        if (!$advertise) {
            return response()->json(['advertise' => 'O anúncio com o id '.$request->id.' não foi encontrado!']);
        }

        return response()->json(['advertise' => $advertise]);
    }

    public function info(Request $request): JsonResponse
    {
        $advertise = $this->advertise->find($request->id);

        if (!$advertise) {
            return response()->json(['message' => 'O anúncio com o id '.$request->id.' não foi encontrado!']);
        }

        $advertise = [
            'title' => $advertise->title,
            'price' => $advertise->price,
            'isNegotiable' => $advertise->isNegotiable,
            'description' => $advertise->description,
            'user' => $advertise->user->name,
            'category' => $advertise->category->name,
            'state' => $advertise->state->name,
            'views' => $advertise->views
        ];

        $response = [
            'error' => '',
            'advertise' => $advertise
        ];

        return response()->json($response);
    }

    /**
     * @param Request $request string
     * 
     * return JsonResponse array
     */
    public function create(CreateAdvertiseRequest $request): JsonResponse
    {
        $data = $request->only(['title', 'price', 'isNegotiable', 'description', 'user_id', 'category_id', 'state_id', 'views']);

        $advertise = $this->advertise->create($data);

        $response = [
            'error' => '',
            'advertise' => $advertise
        ];

        return response()->json([$response]);
    }

    /**
     * @param Request $request string
     * 
     * return JsonResponse array
     */
    public function update(CreateAdvertiseRequest $request): JsonResponse
    {
        $data = $request->only(['title', 'price', 'isNegotiable', 'description', 'user_id', 'category_id', 'state_id', 'views']);

        $response = $this->advertise->find($request->id);

        if (!$response) {
            return response()->json(['message' => 'Não foi encontrado um anúncio com o id '.$request->id.' para ser alterado!']);
        }

        $response->update($data);
        $response->save();

        $response = [
            'error' => '',
            'advertise' => $response
        ];

        return response()->json([$response]);
    }

    /**
     * @param Request request string
     * 
     * return JsonResponse array
     */
    public function delete(Request $request): JsonResponse
    {
        $advertise = $this->advertise->find($request->id);
        
        if (!$advertise) {
            return response()->json(['message' => 'O anúncio não foi deletado pois não foi encontrado o anúncio com id '.$request->id]);
        }

        $advertise->delete();

        $response = [
            'error' => '',
            'message' => 'O anúncio com o id '.$request->id.' foi deletado com sucesso!' 
        ];

        return response()->json(['advertise' => $response]);
    }

    public function restore(Request $request)
    {
        $advertise = $this->advertise->withTrashed()->find($request->id);

        if (!$advertise) {
            return response()->json(['message' => 'O anúncio com o id '.$request->id.' não foi restaurado pois o id não foi encontrado!']);
        }
        
        $advertise->restore();

        $response = [
            'error' => '',
            'message' => 'O anúncio com o id '.$request->id.' foi restaurado com sucesso!'
        ];

        return response()->json(['data' => $response]);
    }
}
