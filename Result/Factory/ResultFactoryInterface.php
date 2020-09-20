<?php

namespace Result\Factory;

use Error\ErrorInterface;
use Result\ResultInterface;

interface ResultFactoryInterface
{
    public function createSuccessResult(): ResultInterface;

    public function createErrorResult(ErrorInterface  $error): ResultInterface;
}