<?php
namespace App\Traits;

use App\Events\StoreLogsEvent;

trait CreateLogTrait
{
    static public function makeLog(string $table,int $id, string $method,int $user_id,array $data)
    {
        event(new StoreLogsEvent(
            $table,
            $id,
            $method,
            $user_id,
            $data
        ));
    }
}