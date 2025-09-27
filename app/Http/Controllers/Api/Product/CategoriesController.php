<?php

namespace App\Http\Controllers\Api\Product;

use App\Business\Services\Category\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\ShowCategoryRequest;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Product\CategoryResource;
use App\Models\Product\Category;
use App\Traits\ApiResponseTraits;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CategoriesController extends Controller
{

    use ApiResponseTraits;

    protected $service;

    public function __construct(CategoryService $category)
    {
        $this->service = $category;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            return CategoryResource::collection($this->service->paginate())
            ->response()
            ->setStatusCode(Response::HTTP_OK);   
        } catch (\Throwable $th) {
            report($th);
            return $this->errorResponse('Dados indisponíveis no momento',['message'=>$th->getMessage()],Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        try {
            $category = $this->service->create($request->validated());
            return (new CategoryResource($category))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            report($th);
            return $this->errorResponse('Erro ao cadastrar a categoria',['message'=>$th->getMessage()],Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowCategoryRequest $request): JsonResponse
    {   
        try {
            $category = $this->service->get($request->id);
            return (new CategoryResource($category))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        } catch (\Throwable $th) {
            report($th);
            return $this->errorResponse('Erro ao atualizar categoria',['message'=>$th->getMessage()],Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request): JsonResponse
    {
        try {
            $this->service->update($request->id,$request->validated());
            return $this->successResponse('Categoria atualizada com sucesso!',[],Response::HTTP_OK);
        } catch (\Throwable $th) {
            report($th);
            return $this->errorResponse('Erro ao atualizar categoria',['message'=>$th->getMessage()],Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShowCategoryRequest $request)
    {
        try {
            $this->service->delete($request->id);
            $this->successResponse('Categoria excluída com sucesso!',[],Response::HTTP_OK);
        } catch (\Throwable $th) {
            report($th);
            return $this->errorResponse($th->getMessage(),[],Response::HTTP_BAD_GATEWAY);
        }
    }
}
