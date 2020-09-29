<?php


namespace ZoranWong\EloquentModelQueryTrait;


use RuntimeException;
use Throwable;

class ModelAccessException extends RuntimeException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
