<?php

namespace App\Http\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class DatabaseException extends HttpException {

    public function __construct(string $message) {
        parent::__construct($message, 500);
    }
}
