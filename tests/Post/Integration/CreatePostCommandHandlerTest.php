<?php

declare(strict_types=1);

namespace App\Tests\Post\Integration;

use App\Post\Application\Command\CreatePostCommand;
use App\Post\Application\Command\CreatePostCommandHandler;
use App\Post\Domain\PostRepository;
use App\User\Infrastructure\Doctrine\Fixtures\UserFixtures;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CreatePostCommandHandlerTest extends KernelTestCase
{
    public function testSuccess(): void
    {
        $cancelPartyCommandHandler = $this->getContainer()->get(CreatePostCommandHandler::class);

        $cancelPartyCommandHandler->__invoke(new CreatePostCommand(
            id: Uuid::fromString('8acc678e-ecb0-441a-a507-eab47dd30d12'),
            title: 'title',
            content: 'content',
            authorId: Uuid::fromString(UserFixtures::USER_ID_1),
        ));

        $post = $this->getContainer()->get(PostRepository::class)
            ->findById(Uuid::fromString('8acc678e-ecb0-441a-a507-eab47dd30d12'));

        self::assertEquals('8acc678e-ecb0-441a-a507-eab47dd30d12', $post->getId()->toString());
        self::assertEquals('title', $post->getTitle());
        self::assertEquals('content', $post->getContent());
        self::assertEquals(UserFixtures::USER_ID_1, $post->getAuthorId()->toString());
        self::assertInstanceOf(DateTimeImmutable::class, $post->getCreatedAt());
    }
}
