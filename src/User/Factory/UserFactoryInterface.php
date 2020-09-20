<?php

declare(strict_types=1);

namespace App\User\Factory;

use App\User\UserInterface;

interface UserFactoryInterface
{
    public function create(
        string $id,
        string $name,
        int $viewCount
    ): UserInterface;
}
