<?php

declare(strict_types=1);

namespace App\Shared\Application;

use Ramsey\Uuid\UuidInterface;

interface UuidProvider
{
    public function provide(): UuidInterface;
}
