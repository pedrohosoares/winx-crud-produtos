<?php

namespace App\Listeners;

use App\Events\StoreLogsEvent;
use App\Jobs\Log\WriteLogJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StorageLogsListener
{
    /**
     * Handle the event.
     */
    public function handle(StoreLogsEvent $event): void
    {
        WriteLogJob::dispatch(
            $event->table(),
            $event->entityId(),
            $event->action(),
            $event->userId(),
            $event->data()
        );  
    }
}
