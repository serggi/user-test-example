<?php

declare(strict_types=1);

namespace App\User\Storage;

use App\User\Storage\Memcache\KeyGenerator\MemcacheKeyGeneratorInterface;
use App\User\Storage\Result\Serializer\UserStorageFindByIdsResultSerializerInterface;
use App\User\UserInterface;
use App\User\Storage\Result\UserStorageFindByIdsResultInterface;
use Memcached;

class CachedUserStorageDecorator implements UserStorageInterface
{
    private UserStorageInterface $storage;

    private Memcached $memcached;

    private MemcacheKeyGeneratorInterface $keyGenerator;

    private UserStorageFindByIdsResultSerializerInterface $serializer;

    public function __construct(
        UserStorageInterface $storage,
        Memcached $memcached,
        MemcacheKeyGeneratorInterface $keyGenerator,
        UserStorageFindByIdsResultSerializerInterface $serializer
    ) {
        $this->storage   = $storage;
        $this->memcached = $memcached;
        $this->keyGenerator = $keyGenerator;
        $this->serializer = $serializer;
    }

    public function findById(string $id): ?UserInterface
    {
        $key = $this->keyGenerator->generateKeyById($id);
        if (null !== $result = $this->memcached->get($key)) {
            return $result;
        }

        if (null !== $result = $this->storage->findById($id)) {
            $this->memcached->set($this->keyGenerator->generateKeyById($id), $result);
        }

        return $result;
    }

    public function findByIds(array $ids): UserStorageFindByIdsResultInterface
    {
        $key = $this->keyGenerator->generateKeyByIds($ids);
        if (null !== $result = $this->memcached->get($key)) {
            return $this->serializer->deserialize($result);
        }

        if (null !== $result = $this->storage->findByIds($ids)) {
            $this->memcached->set($key, $this->serializer->serialize($result));
        }

        return $result;
    }

    public function create(UserInterface $user): bool
    {
        // TODO: Implement create() method.
    }

    public function replace(UserInterface $oldUser, UserInterface $newUser): bool
    {
        // TODO: Implement replace() method.
    }
}
