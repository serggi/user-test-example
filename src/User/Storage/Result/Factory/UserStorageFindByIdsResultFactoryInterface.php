<?php

declare(strict_types=1);

namespace App\User\Storage\Result\Factory;

use App\User\Storage\Result\UserStorageFindByIdsResultInterface;
use Error\ErrorInterface;
use Traversable;

interface UserStorageFindByIdsResultFactoryInterface
{
    public function createSuccess(
        int $count,
        Traversable $users
    ): UserStorageFindByIdsResultInterface;

    public function createError(
        ErrorInterface $error
    ): UserStorageFindByIdsResultInterface;
}
