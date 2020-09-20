<?php

namespace Error\Factory;

use Error\ErrorInterface;

interface ErrorFactoryInterface
{
    public function create(
        string $code,
        string $message,
        array $data = []
    ): ErrorInterface;
}