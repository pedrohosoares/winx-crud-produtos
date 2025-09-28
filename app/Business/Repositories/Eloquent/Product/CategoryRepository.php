<?php
namespace App\Business\Repositories\Eloquent\Product;

use App\Business\Repositories\Contracts\CategoryRepositoryInterface;
use App\Business\Repositories\Eloquent\BaseRepositoryAbstract;
use App\Models\Product\Category;
use App\Support\FilterSupport;

class CategoryRepository extends BaseRepositoryAbstract implements CategoryRepositoryInterface
{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
    
    public function paginate(array $query): object
    {
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'id','');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'name','');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'page','1');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'limit','25');
        $query = FilterSupport::verifyIfEmptyValueByArray($query,'order','DESC');
        $model = $this->model;
        if($query['id'])
        {
            $model = $model->where('categories.id',$query['id']);
        }
        if($query['name'])
        {
            $model = $model->where('categories.name','like','%'.$query['name'].'%');
        }
        
        $model = $model->orderBy('categories.id',$query['order']);
        return $this->model->paginate($query['limit']);
    }
}