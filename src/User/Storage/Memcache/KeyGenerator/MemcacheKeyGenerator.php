<?php

declare(strict_types=1);

namespace App\User\Storage\Memcache\KeyGenerator;

class MemcacheKeyGenerator implements MemcacheKeyGeneratorInterface
{
    private const CACHE_TEMPLATE = 'User::%s';

    public function generateKeyById(string $id): string
    {
        return $this->getKey($id);
    }

    public function generateKeyByIds(array $ids): string
    {
        return $this->getKey(implode('|', $ids));
    }

    private function getKey(string $postfix): string
    {
        return sprintf(self::CACHE_TEMPLATE, $postfix);
    }
}
