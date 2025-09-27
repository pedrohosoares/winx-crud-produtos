<?php
namespace App\Business\Repositories\Eloquent\Product;

use App\Business\Repositories\Contracts\ProductRepositoryInterface;
use App\Business\Repositories\Eloquent\BaseRepositoryAbstract;
use App\Models\Product\Product;

class ProductRepository extends BaseRepositoryAbstract implements ProductRepositoryInterface
{

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

}