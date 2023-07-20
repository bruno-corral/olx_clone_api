<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index() : JsonResponse
    {
        $categories = $this->category->all();

        return response()->json(['data' => $categories]);
    }

    public function findOne(Request $request): JsonResponse
    {
        $category = $this->category->find($request->id);

        if (!$category) {
            return response()->json(['message' => 'A categoria com o id '.$request->id.' não foi encontrada!']);
        }

        $response = [
            'error' => '',
            'message' => 'Categoria encontrada com sucesso!',
            'category' => $category
        ];

        return response()->json(['data' => $response]);
    }

    public function create(CreateCategoryRequest $request): JsonResponse
    {
        $data = $request->only(['name', 'slug']);

        $category = $this->category->create($data);

        $response = [
            'error' => '',
            'message' => 'Categoria criada com sucesso!',
            'category' => $category
        ];

        return response()->json(['data' => $response]);
    }

    public function update(CreateCategoryRequest $request): JsonResponse
    {
        $data = $request->only(['name', 'slug']);

        $category = $this->category->find($request->id);

        if (!$category) {
            return response()->json(['message' => 'A categoria não foi atualizada pois o id '.$request->id.' não foi encontrado!']);
        }

        $category->update($data);
        $category->save();

        $response = [
            'error' => '',
            'message' => 'A categoria foi atualizada com sucesso!',
            'category' => $category
        ];

        return response()->json(['data' => $response]);
    }

    public function delete(Request $request)
    {
        $category = $this->category->find($request->id);

        if (!$category) {
            return response()->json(['message' => 'A categoria com o id '.$request->id.' não foi deletada pois não foi encontrada']);
        }

        $category->delete();

        $response = [
            'error' => '',
            'message' => 'A categoria com o id '.$request->id.' foi deletada com sucesso',
            'category' => $category
        ];

        return response()->json(['data' => $response]);
    }

    public function restore(Request $request)
    {
        $category = $this->category->withTrashed()->find($request->id);

        if (!$category) {
            return response()->json(['message' => 'A categoria com o id '.$request->id.' não foi restaurada pois o id não foi encontrado!']);
        }
        
        $category->restore();

        $response = [
            'error' => '',
            'message' => 'A categoria com o id '.$request->id.' foi restaurado com sucesso!'
        ];

        return response()->json(['data' => $response]);
    }
}
