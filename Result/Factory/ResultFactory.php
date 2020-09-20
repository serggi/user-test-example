<?php

namespace Result\Factory;

use Error\ErrorInterface;
use Result\Result;
use Result\ResultInterface;

class ResultFactory implements ResultFactoryInterface
{
    public function createSuccessResult(): ResultInterface
    {
        return new Result();
    }

    public function createErrorResult(ErrorInterface $error): ResultInterface
    {
        return new Result($error);
    }
}