<?php

declare(strict_types=1);

namespace App\User\Storage\Result\Serializer;

use App\User\Storage\Result\Factory\UserStorageFindByIdsResultFactoryInterface;
use App\User\Storage\Result\UserStorageFindByIdsResultInterface;

class UserStorageFindByIdsResultSerializer implements UserStorageFindByIdsResultSerializerInterface
{
    private UserStorageFindByIdsResultFactoryInterface $resultFactory;

    public function __construct(UserStorageFindByIdsResultFactoryInterface $resultFactory)
    {
        $this->resultFactory = $resultFactory;
    }

    public function serialize(UserStorageFindByIdsResultInterface $result): array
    {
        return $result->jsonSerialize();
    }

    public function deserialize(array $result): UserStorageFindByIdsResultInterface
    {
        return $this->resultFactory->createSuccess(
            $result[UserStorageFindByIdsResultInterface::FIELD_COUNT],
            $result[UserStorageFindByIdsResultInterface::FIELD_USERS],
        );
    }
}
