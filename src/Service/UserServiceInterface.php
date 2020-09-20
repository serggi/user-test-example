<?php

declare(strict_types=1);

namespace App\Service;

interface UserServiceInterface
{
    //такий метод чисто для прикладу, по хорошому такого бути не повинно
    public function getUserVisits(string $userId): int;
}
