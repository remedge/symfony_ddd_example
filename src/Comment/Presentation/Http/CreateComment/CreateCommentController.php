<?php

declare(strict_types=1);

namespace App\Comment\Presentation\Http\CreateComment;

use App\Comment\Application\Command\CreateCommentCommand;
use App\Shared\Application\Clock;
use App\Shared\Application\UuidProvider;
use Fusonic\HttpKernelExtensions\Attribute\FromRequest;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreateCommentController
{
    public function __construct(
        private MessageBusInterface $commandBus,
        private UuidProvider $uuidProvider,
        private Clock $clock,
    ) {
    }

    #[Route(path: '/comment', methods: [Request::METHOD_POST])]
    public function __invoke(
        #[FromRequest] CreateCommentRequest $request,
    ): Response {
        $this->commandBus->dispatch(
            new CreateCommentCommand(
                id: $this->uuidProvider->provide(),
                postId: Uuid::fromString($request->postId),
                content: $request->content,
                authorId: Uuid::fromString($request->authorId),
                createdAt: $this->clock->now(),
            ),
        );

        return new Response();
    }
}
