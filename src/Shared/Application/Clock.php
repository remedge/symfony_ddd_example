<?php

declare(strict_types=1);

namespace App\Shared\Application;

use DateTimeImmutable;

interface Clock
{
    public function now(): DateTimeImmutable;
}
