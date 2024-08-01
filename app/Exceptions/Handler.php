<?php

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Exceptions\JWTException as CustomJWTException;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TokenExpiredException) {
            throw new CustomJWTException('Token has expired');
        } elseif ($exception instanceof TokenInvalidException) {
            throw new CustomJWTException('Token is invalid');
        } elseif ($exception instanceof JWTException) {
            throw new CustomJWTException('Token is not provided');
        }

        return parent::render($request, $exception);
    }
}
