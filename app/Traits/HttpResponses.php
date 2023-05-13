<?php

namespace App\Traits;

trait HttpResponses
{
    /**
     * Create success json response 
     *
     * @param mixed $data
     * @param string $message
     * @var int $code
     * @return Illuminate\Http\JsonResponse
     */
    protected function success($data, $code = 200)
    {
        return response()->json([
            'data' => $data
        ], $code);
    }

    /**
     * Create success json response 
     *
     * @param mixed $data
     * @var int $code
     * @return Illuminate\Http\JsonResponse
     */
    protected function error($code, $errors = [], $message = "")
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
