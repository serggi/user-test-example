<?php

declare(strict_types=1);

namespace App\User\Storage\Result\Serializer;

use App\User\Storage\Result\UserStorageFindByIdsResultInterface;

interface UserStorageFindByIdsResultSerializerInterface
{
    public function serialize(UserStorageFindByIdsResultInterface $result): array;

    public function deserialize(array $result): UserStorageFindByIdsResultInterface;
}
