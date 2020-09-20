<?php

namespace Error;

use JsonSerializable;

interface ErrorInterface extends JsonSerializable
{
    public function getCode(): string;

    public function getMessage(): string;

    public function getData(): array;
}