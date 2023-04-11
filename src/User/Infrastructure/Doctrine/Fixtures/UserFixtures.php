<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Doctrine\Fixtures;

use App\User\Domain\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class UserFixtures extends Fixture
{
    public const USER_ID_1 = '00000000-0000-0000-0000-000000000001';

    public function load(ObjectManager $manager): void
    {
        $product = new User(
            id: Uuid::fromString(self::USER_ID_1),
            username: 'test-user',
        );
        $manager->persist($product);

        $manager->flush();
    }
}
