<?php

declare(strict_types=1);

namespace App\Tests\Post\Unit;

use App\Post\Domain\Post;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class PostTest extends TestCase
{
    public function testSuccess(): void
    {
        $post = new Post(
            id: Uuid::fromString('00000000-0000-0000-0000-000000000000'),
            title: 'title',
            content: 'content',
            authorId: Uuid::fromString('00000000-0000-0000-0000-000000000000'),
            createdAt: new DateTimeImmutable(),
        );

        self::assertEquals('00000000-0000-0000-0000-000000000000', $post->getId()->toString());
        self::assertEquals('title', $post->getTitle());
        self::assertEquals('content', $post->getContent());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $post->getAuthorId()->toString());
        self::assertInstanceOf(DateTimeImmutable::class, $post->getCreatedAt());
    }
}
