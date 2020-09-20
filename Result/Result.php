<?php

namespace Result;

use Error\ErrorInterface;

class Result implements ResultInterface
{
    public const FIELD_ERROR = 'error';

    private ?ErrorInterface $error;

    public function __construct(?ErrorInterface $error = null)
    {
        $this->error = $error;
    }

    public function getError(): ?ErrorInterface
    {
        return $this->error;
    }

    public function jsonSerialize()
    {


        return [
            self::FIELD_ERROR => $this->error
        ];
    }
}