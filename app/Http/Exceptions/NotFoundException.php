<?php

namespace App\Http\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class NotFoundException extends HttpException {

    public function __construct(string $message) {
        parent::__construct($message, 404);
    }
}
