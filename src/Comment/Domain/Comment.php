<?php

declare(strict_types=1);

namespace App\Comment\Domain;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

class Comment
{
    public function __construct(
        private readonly UuidInterface $id,
        private readonly UuidInterface $postId,
        private string $content,
        private readonly UuidInterface $authorId,
        private readonly DateTimeImmutable $createdAt,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getPostId(): UuidInterface
    {
        return $this->postId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAuthorId(): UuidInterface
    {
        return $this->authorId;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
