<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Ramsey;

use App\Shared\Application\UuidProvider;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class RamseyUuidProvider implements UuidProvider
{
    public function provide(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
