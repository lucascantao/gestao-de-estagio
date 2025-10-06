<?php

namespace App\utils\traits;

trait Exception {
    public function exception($e, $file = null, $method = null) {
        return [
            'message' => $e->getMessage(),
                'origin' => [
                    'file' => $file,
                    'method' => $method
                ],
            ];
    }

}
