<?php

declare(strict_types=1);

namespace App\User\Presentation\Http;

readonly class UserResponse
{
    public function __construct(
        public string $id,
        public string $username,
    ) {
    }
}
