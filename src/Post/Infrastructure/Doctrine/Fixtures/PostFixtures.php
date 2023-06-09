<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Doctrine\Fixtures;

use App\Post\Domain\Post;
use App\User\Infrastructure\Doctrine\Fixtures\UserFixtures;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class PostFixtures extends Fixture
{
    public const POST_ID_1 = '9e0b14de-0377-41b6-b624-c43d99896302';

    public function load(ObjectManager $manager): void
    {
        $post = new Post(
            id: Uuid::fromString(self::POST_ID_1),
            title: 'test-post',
            content: 'test-content',
            authorId: Uuid::fromString(UserFixtures::USER_ID_1),
            createdAt: new DateTimeImmutable('2021-01-01 00:00:00'),
        );
        $manager->persist($post);

        $manager->flush();
    }
}
