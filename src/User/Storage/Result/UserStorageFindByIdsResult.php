<?php

declare(strict_types=1);

namespace App\User\Storage\Result;

use Error\ErrorInterface;
use Result\Result;
use Traversable;

class UserStorageFindByIdsResult extends Result implements UserStorageFindByIdsResultInterface
{
    private int $count;
    private Traversable $users;

    public function __construct(int $count, Traversable $users, ?ErrorInterface $error = null)
    {
        $this->count = $count;
        $this->users = $users;
        parent::__construct($error);
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getUsers(): Traversable
    {
        return $this->users;
    }

    public function jsonSerialize()
    {
        $result = parent::jsonSerialize();
        $result[self::FIELD_COUNT] = $this->count;
        $result[self::FIELD_USERS] = iterator_to_array($this->users);

        return $result;
    }
}
