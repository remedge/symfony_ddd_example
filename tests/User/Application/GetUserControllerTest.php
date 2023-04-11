<?php

declare(strict_types=1);

namespace App\Tests\User\Application;

use App\User\Infrastructure\Doctrine\Fixtures\UserFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetUserControllerTest extends WebTestCase
{
    public function testSuccess(): void
    {
        $client = static::createClient();

        $client->request(
            method: 'GET',
            uri: sprintf('/users/%s', UserFixtures::USER_ID_1),
        );
        $this->assertResponseIsSuccessful();
        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertEquals([
            'id' => UserFixtures::USER_ID_1,
            'username' => 'test-user',
        ], $response);
    }

    public function testNotFound(): void
    {
        $client = static::createClient();

        $client->request(
            method: 'GET',
            uri: '/users/00000000-0000-0000-0000-000000000000',
        );
        $this->assertResponseStatusCodeSame(404);
    }
}
