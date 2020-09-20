<?php

namespace Error\Factory;

use Error\Error;
use Error\ErrorInterface;

class ErrorFactory implements ErrorFactoryInterface
{
    public function create(
        string $code,
        string $message,
        array $data = []
    ): ErrorInterface {
        return new Error($code, $message, $data);
    }
}