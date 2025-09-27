<?php

namespace App\Http\Controllers\Api\Product;

use App\Business\Services\Product\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ShowProductRequest;
use App\Http\Requests\Product\SearchProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Traits\ApiResponseTraits;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{

    use ApiResponseTraits;

    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SearchProductRequest $request)
    {
        try {
            return ProductResource::collection($this->service->paginate());
        } catch (\Throwable $th) {
            return $this->errorResponse('Dados indisponíveis no momento',['message'=>$th->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $product = $this->service->create($request->validated());
            return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
        } catch (\Throwable $th) {
            report($th);
            return $this->errorResponse('Falha ao cadastrar o produto',['message'=>$th->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowProductRequest $request)
    {
        try {
            $product = $this->service->get($request->id);
            return (new ProductResource($product))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        } catch (\Throwable $th) {
            report($th);
            return $this->errorResponse('Erro ao exibir Produto',['message'=>$th->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        try {
            $this->service->update($request->id,$request->validated());
            return $this->successResponse('Produto atualizado com sucesso!',[],Response::HTTP_OK);
        } catch (\Throwable $th) {
            report($th);
            return $this->errorResponse('Erro ao atualizar produto',['message'=>$th->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShowProductRequest $request)
    {
        try {
            $this->service->delete($request->id);
            return $this->successResponse('Produto excluído com sucesso!',[],Response::HTTP_OK);
        } catch (\Throwable $th) {
            report($th);
            return $this->errorResponse($th->getMessage(),[],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
