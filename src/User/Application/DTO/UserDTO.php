<?php

declare(strict_types=1);

namespace App\User\Application\DTO;

use Ramsey\Uuid\UuidInterface;

class UserDTO
{
    public function __construct(
        public UuidInterface $id,
        public string $username,
    ) {
    }
}
