<?php

declare(strict_types=1);

namespace App\User;

interface UserInterface
{
    public function getId(): string;

    public function getName(): string;

    public function getViewCount(): int;

    // another fields
}
