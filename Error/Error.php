<?php

namespace Error;

use http\Params;

class Error implements ErrorInterface
{
    public const FIELD_CODE = 'code';

    public const FIELD_MESSAGE = 'message';

    public const FIELD_DATA = 'data';

    private string $code;

    private string $message;

    private array $data;

    public function __construct(
      string $code,
      string $message,
      array $data
    ) {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function jsonSerialize()
    {
        return [
            self::FIELD_CODE => $this->code,
            self::FIELD_MESSAGE => $this->message,
            self::FIELD_DATA => $this->data,
        ];
    }
}