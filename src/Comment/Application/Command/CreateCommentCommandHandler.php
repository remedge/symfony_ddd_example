<?php

declare(strict_types=1);

namespace App\Comment\Application\Command;

use App\Comment\Domain\Comment;
use App\Comment\Domain\CommentRepository;
use App\Comment\Domain\Event\CommentCreatedEvent;
use App\Post\Application\Query\PostQuery;
use App\User\Application\Query\UserQuery;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateCommentCommandHandler
{
    public function __construct(
        private CommentRepository $commentRepository,
        private EventDispatcherInterface $eventDispatcher,
        private PostQuery $postQuery,
        private UserQuery $userQuery,
    ) {
    }

    public function __invoke(CreateCommentCommand $command): void
    {
        $this->postQuery->getById($command->postId);
        $this->userQuery->getById($command->authorId);

        $this->commentRepository->save(
            new Comment(
                id: $command->id,
                postId: $command->postId,
                content: $command->content,
                authorId: $command->authorId,
                createdAt: $command->createdAt,
            )
        );

        $this->eventDispatcher->dispatch(new CommentCreatedEvent(
            id: $command->id,
            postId: $command->postId,
            authorId: $command->authorId,
        ));
    }
}
