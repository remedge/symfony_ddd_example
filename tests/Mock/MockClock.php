<?php

declare(strict_types=1);

namespace App\Tests\Mock;

use App\Shared\Application\Clock;
use DateTimeImmutable;

class MockClock implements Clock
{
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('2011-01-01 11:11:11');
    }
}
