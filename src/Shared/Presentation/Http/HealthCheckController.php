<?php

declare(strict_types=1);

namespace App\Shared\Presentation\Http;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

readonly class HealthCheckController
{
    public function __construct(
        private KernelInterface $kernel,
    ) {
    }

    #[Route(path: '/health-check', methods: [Request::METHOD_GET])]
    public function __invoke(): Response
    {
        $application = new Application($this->kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'doctrine:schema:validate',
        ]);

        $result = $application->run($input);

        if ($result !== 0) {
            return new Response('DB Schema is not synced', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response('ok');
    }
}
