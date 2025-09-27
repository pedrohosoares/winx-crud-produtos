<?php

namespace App\Http\Controllers\Api\Product;

use App\Business\Services\Product\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ExistProductRequest;
use App\Http\Requests\Product\SearchProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

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
        return ProductResource::collection($this->service->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->all();
        $meta = $data['meta'];
        unset($data['meta']);
        
        DB::transaction(function() use ($data,$meta){
            $product = new Product();
            $product->fill($data);
            $product->save();
            dd($product);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(ExistProductRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExistProductRequest $request)
    {
        //
    }
}
