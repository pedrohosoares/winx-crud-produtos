<?php

namespace App\Business\Services;

use App\Business\Repositories\Contracts\BaseRepositoryInterface;
use App\Business\Services\Product\Contracts\BaseServiceInterface;
use App\Support\AuthSupport;
use App\Traits\CreateLogTrait;
use Illuminate\Support\Facades\DB;

abstract class BaseServiceAbstract implements BaseServiceInterface
{

    use CreateLogTrait;

    protected $repository;
    

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getTable(): string
    {
        return $this->repository->getTable();
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
            $transaction = $this->repository->create($data);
            $this->makeLog(
                $this->repository->getTable(),
                $transaction->id,
                'created',
                AuthSupport::authID(),
                $data
            );
            return $transaction;
        });
    }

    public function update(int $id, array $data): bool
    {
        return DB::transaction(function() use ($id,$data){
            $transaction = $this->repository->update($id,$data);
            $this->makeLog(
                $this->repository->getTable(),
                $id,
                'updated',
                AuthSupport::authID(),
                $data
            );
            return $transaction;
        }); 
    }

    public function delete(int $id): bool
    {
        return DB::transaction(function() use($id){
            $transaction = $this->repository->delete($id);
            $this->makeLog(
                $this->repository->getTable(),
                $id,
                'deleted',
                AuthSupport::authID(),
                []
            );
            return $transaction;
        });
    }
}
