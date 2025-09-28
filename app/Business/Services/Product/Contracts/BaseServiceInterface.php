<?php
namespace App\Business\Services\Product\Contracts;

interface BaseServiceInterface
{
    public function paginate(array $query): object;
    public function all();
    public function get(int $id): ?object;
    public function create(array $data): object;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}