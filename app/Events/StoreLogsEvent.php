<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreLogsEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        protected string $table,
        protected int|string $entityId,
        protected string $action,
        protected ?int $userId = null,
        protected array $data = []
    ) {
    }

    public function table(): string      
    { 
        return $this->table; 
    }
    public function entityId(): int|string 
    { 
        return $this->entityId; 
    }
    public function action() 
    { 
        return $this->action; 
    }
    public function userId(): ?int    
    { 
        return $this->userId; 
    }
    public function data(): array      
    { 
        return $this->data; 
    }
    
}
