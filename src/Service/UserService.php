<?php

declare(strict_types=1);

namespace App\Service;

use App\User\Storage\UserStorageInterface;

class UserService implements UserServiceInterface
{
    private UserStorageInterface $userStorage;

    public function __construct(UserStorageInterface $storage)
    {
        $this->userStorage = $storage;
    }

    public function getUserVisits(string $userId): int
    {
        if (null === $user = $this->userStorage->findById($userId)) {
            return 0;
        }

        return $user->getViewCount();
    }
}
