<?php

declare(strict_types=1);

namespace App\Post\Presentation\Http;

use App\Post\Application\Command\CreatePostCommand;
use App\Shared\Application\UuidProvider;
use Fusonic\HttpKernelExtensions\Attribute\FromRequest;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

readonly class CreatePostController
{
    public function __construct(
        private MessageBusInterface $commandBus,
        private UuidProvider $uuidProvider,
    ) {
    }

    #[Route(path: '/post', methods: [Request::METHOD_POST])]
    public function __invoke(
        #[FromRequest] CreatePostRequest $request,
    ): Response {
        $this->commandBus->dispatch(
            new CreatePostCommand(
                id: $this->uuidProvider->provide(),
                title: $request->title,
                content: $request->content,
                authorId: Uuid::fromString($request->authorId),
            ),
        );

        return new Response();
    }
}
