<?php

namespace App\Business\Services;

use App\Business\Repositories\Contracts\BaseRepositoryInterface;
use App\Business\Services\Product\Contracts\BaseServiceInterface;
use Illuminate\Support\Facades\DB;

abstract class BaseServiceAbstract implements BaseServiceInterface
{

    protected $repository;

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function paginate(array $query): object
    {
        return $this->repository->paginate($query);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function get(int $id): ?object
    {
        return $this->repository->find($id);
    }

    public function create(array $data): object
    {
        return DB::transaction(function () use ($data) {
            return $this->repository->create($data);
        });
    }

    public function update(int $id, array $data): bool
    {
        return DB::transaction(function() use ($id,$data){
            return $this->repository->update($id,$data);
        }); 
    }

    public function delete(int $id): bool
    {
        return DB::transaction(function() use($id){
            return $this->repository->delete($id);
        });
    }
}
