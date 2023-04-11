<?php

declare(strict_types=1);

namespace App\Tests\Post\Application;

use App\User\Infrastructure\Doctrine\Fixtures\UserFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreatePostController extends WebTestCase
{
    public function testCreatePost(): void
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
}
