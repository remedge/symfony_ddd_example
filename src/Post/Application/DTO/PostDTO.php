<?php

declare(strict_types=1);

namespace App\Post\Application\DTO;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

class PostDTO
{
    public function __construct(
        public UuidInterface $id,
        public string $title,
        public string $content,
        public UuidInterface $authorId,
        public DateTimeImmutable $createdAt,
    ) {
    }
}
