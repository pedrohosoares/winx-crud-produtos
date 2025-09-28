<?php
namespace App\Business\Repositories\Eloquent\Product;

use App\Business\Repositories\Contracts\MetaProductRepositoryInterface;
use App\Models\Product\MetaProduct;

class MetaProductRepository implements MetaProductRepositoryInterface
{
    protected $model;

    public function __construct(MetaProduct $model)
    {
        $this->model = $model;
    }

    public function find(int $product): object
    {
        
    }
}