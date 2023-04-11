<?php

declare(strict_types=1);

namespace App\Post\Application\Command;

use Ramsey\Uuid\UuidInterface;

readonly class CreatePostCommand
{
    public function __construct(
        public UuidInterface $id,
        public string $title,
        public string $content,
        public UuidInterface $authorId,
    ) {
    }
}
