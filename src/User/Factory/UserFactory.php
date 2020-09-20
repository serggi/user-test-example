<?php

declare(strict_types=1);

namespace App\User\Factory;

use App\User\User;
use App\User\UserInterface;

class UserFactory implements UserFactoryInterface
{
    public function create(
        string $id,
        string $name,
        int $viewCount
    ): UserInterface {
        return new User($id, $name, $viewCount);
    }
}
