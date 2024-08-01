<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class JWTException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => 'Token is invalid or expired.',
            'message' => $this->getMessage(),
        ], 401);
    }
}
