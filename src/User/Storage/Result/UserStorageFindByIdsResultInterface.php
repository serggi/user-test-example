<?php

declare(strict_types=1);

namespace App\User\Storage\Result;

use Result\ResultInterface;
use Traversable;

interface UserStorageFindByIdsResultInterface extends ResultInterface
{
    public const FIELD_COUNT = 'count';

    public const FIELD_USERS = 'users';

    public function getCount(): int;

    public function getUsers(): Traversable;
}
