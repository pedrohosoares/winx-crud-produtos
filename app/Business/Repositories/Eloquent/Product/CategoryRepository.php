<?php
namespace App\Business\Repositories\Eloquent\Product;

use App\Business\Repositories\Contracts\CategoryRepositoryInterface;
use App\Business\Repositories\Eloquent\BaseRepositoryAbstract;
use App\Models\Product\Category;

class CategoryRepository extends BaseRepositoryAbstract implements CategoryRepositoryInterface
{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
    
}