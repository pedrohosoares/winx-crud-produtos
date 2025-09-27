<?php
namespace App\Business\Services\Category;

use App\Business\Repositories\Contracts\CategoryRepositoryInterface;
use App\Business\Services\BaseServiceAbstract;
use App\Business\Services\Product\Contracts\CategoryServiceInterface;

class CategoryService extends BaseServiceAbstract implements CategoryServiceInterface
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $category)
    {
        parent::__construct($category);
    }

}