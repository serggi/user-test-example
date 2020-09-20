<?php

declare(strict_types=1);

namespace App\User\Storage;

use App\User\Storage\Result\UserStorageFindByIdsResultInterface;
use App\User\UserInterface;

interface UserStorageInterface
{
    public function findById(string $id): ?UserInterface;

    public function findByIds(array $ids): UserStorageFindByIdsResultInterface;

    // iso return bool better to create resultInterface
    public function create(UserInterface $user): bool;

    // iso return bool better to create resultInterface
    public function replace(UserInterface $oldUser, UserInterface $newUser): bool;
}
