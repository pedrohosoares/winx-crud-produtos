<?php
namespace App\Business\Services\Product\Contracts;

use Illuminate\Http\Request;

interface BaseServiceInterface
{
    public function paginate(int $limit);
    public function all();
    public function get(int $id): ?object;
    public function create(array $data): object;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}