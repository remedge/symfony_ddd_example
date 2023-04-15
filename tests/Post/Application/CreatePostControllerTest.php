<?php

declare(strict_types=1);

namespace App\Tests\Post\Application;

use App\User\Infrastructure\Doctrine\Fixtures\UserFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreatePostControllerTest extends WebTestCase
{
    public function testSuccess(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'POST',
            uri: '/post',
            server: [
                'CONTENT_TYPE' => 'application/json',
            ],
            content: json_encode([
                'title' => 'Test title',
                'content' => 'Test content',
                'authorId' => UserFixtures::USER_ID_1,
            ]),
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testInvalidInput(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'POST',
            uri: '/post',
            server: [
                'CONTENT_TYPE' => 'application/json',
            ],
            content: json_encode([
                'title' => 'Test title',
                'authorId' => UserFixtures::USER_ID_1,
            ]),
        );

        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertEquals('ConstraintViolation: This value should not be null.', $response['message']);
    }
}
