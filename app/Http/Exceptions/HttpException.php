<?php

namespace App\Http\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

abstract class HttpException extends Exception {
    protected int $statusCode;

    public function __construct(string $message, int $statusCode)  {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    public function report(): void {
        Log::error('Exception Message:: ' . $this->getMessage());
    }

    public function render(): JsonResponse {
        return response()->json(
            ['code' => $this->statusCode, 'message' => $this->getMessage()],
            $this->statusCode
        );
    }
}
