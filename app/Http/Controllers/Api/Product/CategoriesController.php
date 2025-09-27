<?php

namespace App\Http\Controllers\Api\Product;

use App\Business\Services\Category\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\ShowCategoryRequest;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Requests\Product\ExistProductRequest;
use App\Models\Product\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{

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
        dd($request->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();
        try {
            $success = DB::transaction(function() use ($data){
                Category::create($data);
                return true;
            });
        } catch (\Throwable $th) {
            //throw $th;
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
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request)
    {
        try {
            $data = $request->all();
            $db = DB::transaction(function() use ($data){
                $category = Category::find($data['id']);
                $category->name = $data['name'];
                $category->save();
                return true;
            });   
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShowCategoryRequest $request)
    {
        $id = $request->id;
        try {
            return Category::destroy($id);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
