<?php

declare(strict_types=1);

namespace App\User\Domain;

use Ramsey\Uuid\UuidInterface;

class User
{
    public function __construct(
        private UuidInterface $id,
        private string $username,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}
