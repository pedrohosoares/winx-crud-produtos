<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponseTraits
{
    protected function successResponse(string $message,array $data, int $status = Response::HTTP_OK): JsonResponse
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

    protected function errorResponse(string $message,array $data, int $status = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
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