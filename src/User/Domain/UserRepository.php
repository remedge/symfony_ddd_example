<?php

declare(strict_types=1);

namespace App\User\Domain;

use Ramsey\Uuid\UuidInterface;

interface UserRepository
{
    public function findById(UuidInterface $userId): ?User;
}
