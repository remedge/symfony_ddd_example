<?php

declare(strict_types=1);

namespace App\Comment\Application\Command;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

class CreateCommentCommand
{
    public function __construct(
        public UuidInterface $id,
        public UuidInterface $postId,
        public string $content,
        public UuidInterface $authorId,
        public DateTimeImmutable $createdAt,
    ) {
    }
}
