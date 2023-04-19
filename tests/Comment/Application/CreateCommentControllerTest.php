<?php

declare(strict_types=1);

namespace App\Tests\Comment\Application;

use App\Post\Infrastructure\Doctrine\Fixtures\PostFixtures;
use App\User\Infrastructure\Doctrine\Fixtures\UserFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateCommentControllerTest extends WebTestCase
{
    public function testSuccess(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'POST',
            uri: '/comment',
            server: [
                'CONTENT_TYPE' => 'application/json',
            ],
            content: json_encode([
                'postId' => PostFixtures::POST_ID_1,
                'content' => 'Test content',
                'authorId' => UserFixtures::USER_ID_1,
            ]),
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
