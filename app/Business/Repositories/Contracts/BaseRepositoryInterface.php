<?php
namespace App\Business\Repositories\Contracts;

use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    public function paginate();
    public function all(): Collection;        
    public function find(int $id): ?object;  
    public function create(array $data): object;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;   
}