<?php

declare(strict_types=1);

namespace App\User\Storage\Memcache\KeyGenerator;

interface MemcacheKeyGeneratorInterface
{
    public function generateKeyById(string $id): string;

    public function generateKeyByIds(array $ids): string;
}
