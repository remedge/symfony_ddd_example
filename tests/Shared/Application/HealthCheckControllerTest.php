<?php

declare(strict_types=1);

namespace App\Tests\Shared\Application;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthCheckControllerTest extends WebTestCase
{
    public function testSuccess(): void
    {
        $client = static::createClient();

        $client->request('GET', '/health-check');

        $this->assertResponseIsSuccessful();
    }
}
