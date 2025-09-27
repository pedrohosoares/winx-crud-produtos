<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTraits
{
    protected function successResponse(string $message,array $data, int $status = 200): JsonResponse
    {
        return response()->json(
            [
                "message"=>$message,
                "data"=>$data,
                "status"=>"success"
            ],
            $status
        );
    }

    protected function errorResponse(string $message,array $data, int $status = 400): JsonResponse
    {
        return response()->json(
            [
                "message"=>$message,
                "data"=>$data,
                "status"=>"error"
            ],
            $status
        );
    }
}