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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{

    use ApiResponseTraits;

    protected $service;

    public function __construct(CategoryService $product)
    {
        $this->service = $product;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return CategoryResource::collection(Category::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();
        try {
            $success = DB::transaction(function() use ($data){
                return Category::create($data);
            });
            $this->successResponse('Categoria criada com sucesso!',$success);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),[]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowCategoryRequest $request)
    {   
        $id = $request->input('id');
        try {
            return Category::find($id);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),[]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request)
    {
        try {
            $data = $request->all();
            $success = DB::transaction(function() use ($data){
                $category = Category::find($data['id']);
                $category->name = $data['name'];
                $category->save();
                return $category;
            });   
            $this->successResponse('Categoria atualizada com sucesso!',$success);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),[]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShowCategoryRequest $request)
    {
        $id = $request->id;
        try {
            $success = Category::destroy($id);
            if($success){
                $this->successResponse('Categoria excluída com sucesso!',[]);
            }
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),[]);
        }
    }
}
