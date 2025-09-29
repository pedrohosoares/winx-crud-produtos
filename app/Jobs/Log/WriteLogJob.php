<?php

namespace App\Jobs\Log;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WriteLogJob implements ShouldQueue
{
    use Dispatchable;

    public bool $afterCommit = true;

    public function __construct(
        protected string $table,
        protected int|string $id,
        protected string $action,
        protected ?int $userId = null,
        protected array $data = []
    ) {}

    public function handle(): void
    {
        $message = sprintf(
            "[%s] %s - entity: %s, id: %s, user: %s, changes: %s",
            now()->toDateTimeString(),
            strtoupper($this->action),
            $this->table,
            $this->id,
            $this->userId ?? 'sistema',
            json_encode($this->data, JSON_UNESCAPED_UNICODE)
        );

        $channel = strtolower($this->action);
        Log::channel($channel)->info($message);
    }
}
