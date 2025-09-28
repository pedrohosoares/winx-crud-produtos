<?php

namespace App\Jobs\Log;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;

class WriteLogJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public bool $afterCommit = true;   
    public string $queue = 'logs';

    protected $modelClass;
    protected $id;
    protected $action;
    protected $userId;
    protected $changes;
    protected $entity;

    public function __construct(
        Model $modelClass,
        int $id,
        string $action,
        ?int $userId = null,
        array $changes = [],
        string $entity
    ) {
        $this->modelClass = $modelClass;
        $this->id = $id;
        $this->action = $action;
        $this->userId = $userId;
        $this->changes = $changes;
        $this->entity = $entity;
    }

    public function handle(): void
    {
        $model = new $this->modelClass;
        $model->create([
            $this->entity.'_id' => $this->id,
            'user_id'    => $this->userId,
            'action'     => $this->action,
            'changes'    => $this->changes ?: null,
            'logged_at'  => now(),
        ]);
    }
}
