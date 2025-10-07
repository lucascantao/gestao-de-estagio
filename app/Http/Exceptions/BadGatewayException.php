<?php

namespace App\Http\Exceptions;

class BadGatewayException extends HttpException {

    public function __construct(string $message) {
        parent::__construct($message, 502);
    }
}
