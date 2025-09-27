<?php
namespace App\Business\Services\Product;

use App\Business\Repositories\Contracts\ProductRepositoryInterface;
use App\Business\Services\BaseServiceAbstract;

class ProductService extends BaseServiceAbstract
{
    public function __construct(ProductRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}