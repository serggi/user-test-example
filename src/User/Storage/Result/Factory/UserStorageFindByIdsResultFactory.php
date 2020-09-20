<?php

declare(strict_types=1);

namespace App\User\Storage\Result\Factory;

use App\User\Storage\Result\UserStorageFindByIdsResult;
use App\User\Storage\Result\UserStorageFindByIdsResultInterface;
use Error\ErrorInterface;
use Generator;
use Traversable;

class UserStorageFindByIdsResultFactory implements UserStorageFindByIdsResultFactoryInterface
{

    public function createSuccess(int $count, Traversable $users): UserStorageFindByIdsResultInterface
    {
        return new UserStorageFindByIdsResult($count, $users);
    }

    public function createError(ErrorInterface $error): UserStorageFindByIdsResultInterface
    {
        return new UserStorageFindByIdsResult(0, $this->createEmptyGenerator(), $error);
    }

    private function createEmptyGenerator(): Generator
    {
        yield from [];
    }
}
