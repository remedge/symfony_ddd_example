<?php

declare(strict_types=1);

namespace App\Post\Domain;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

class Post
{
    private DateTimeImmutable $updatedAt;

    public function __construct(
        private readonly UuidInterface $id,
        private string $title,
        private string $content,
        private readonly UuidInterface $authorId,
        private readonly DateTimeImmutable $createdAt,
    ) {
        $this->updatedAt = $createdAt;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
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

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
