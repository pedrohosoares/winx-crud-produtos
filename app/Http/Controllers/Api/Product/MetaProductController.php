<?php

namespace App\Http\Controllers\Api\Product;

use App\Business\Services\Product\Contracts\ProductServiceInterface;
use App\Business\Services\Product\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ShowProductRequest;
use App\Http\Resources\Product\MetaProductResource;
use App\Traits\ApiResponseTraits;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MetaProductController extends Controller
{

    use ApiResponseTraits;

    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function show(ShowProductRequest $request): JsonResponse
    {
        try {
            $product = $this->service->get($request->id);
            return (new MetaProductResource($product))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        } catch (\Throwable $th) {
            report($th);
            return $this->errorResponse('Erro ao exibir Produto',['message'=>$th->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
