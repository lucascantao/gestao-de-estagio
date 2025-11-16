<?php

namespace App\utils\traits;

use Exception;

trait ExceptionTrait {
    public function exception(Exception $e, $file = null, $method = null) {
        return [
            'message' => $e->getMessage(),
                'origin' => [
                    'line' => $e->getLine(),
                    'file' => $e->getFile(),
                    'method' => $method,
                    'trace' => $e->getTrace(),
                ],
            ];
    }

}
