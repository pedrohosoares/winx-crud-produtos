<?php

namespace App\Listeners;

use App\Events\StorageActionsLogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class StorageActionsLogListener implements ShouldQueue
{

    public bool $afterCommit = true;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StorageActionsLogEvent $event): void
    {
        Log::alert("EVENTO CRIADO");
    }
}
