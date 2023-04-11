<?php

declare(strict_types=1);

namespace App\Post\Presentation;

use Ramsey\Uuid\UuidInterface;

readonly class CreatePostRequest
{
    public function __construct(
        public string $title,
        public string $content,
        public UuidInterface $authorId,
    ) {
    }
}
