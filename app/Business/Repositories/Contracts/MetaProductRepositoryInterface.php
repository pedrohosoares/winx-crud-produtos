<?php
namespace App\Business\Repositories\Contracts;

interface MetaProductRepositoryInterface
{
    public function find(int $id): ?object;  
}