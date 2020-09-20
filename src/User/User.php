<?php

declare(strict_types=1);

namespace App\User;

class User implements UserInterface
{
    private string $id;
    private string $name;
    private int $viewCount;

    public function __construct(
        string $id,
        string $name,
        int $viewCount
    ) {
        $this->id        = $id;
        $this->name      = $name;
        $this->viewCount = $viewCount;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getViewCount(): int
    {
        return $this->viewCount;
    }
}
