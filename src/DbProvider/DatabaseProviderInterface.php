<?php

namespace App\DbProvider;

interface DatabaseProviderInterface
{
    public function execute(string $query);
}
