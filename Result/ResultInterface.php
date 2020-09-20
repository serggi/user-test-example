<?php

namespace Result;

use Error\ErrorInterface;
use JsonSerializable;

interface ResultInterface extends JsonSerializable
{
    public function getError(): ?ErrorInterface;
}