<?php

declare(strict_types=1);

namespace App\Comment\Application\Event;

use Ramsey\Uuid\UuidInterface;

class CommentCreatedEvent
{
    public function __construct(
        public UuidInterface $id,
        public UuidInterface $postId,
        public UuidInterface $authorId,
    ) {
    }
}
