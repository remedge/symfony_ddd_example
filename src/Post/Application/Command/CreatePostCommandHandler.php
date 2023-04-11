<?php

declare(strict_types=1);

namespace App\Post\Application\Command;

use App\Post\Domain\Post;
use App\Post\Domain\PostRepository;
use App\Shared\Application\Clock;
use App\User\Application\Query\UserQuery;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class CreatePostCommandHandler
{
    public function __construct(
        private PostRepository $postRepository,
        private UserQuery $userQuery,
        private Clock $clock,
    ) {
    }

    public function __invoke(CreatePostCommand $command): void
    {
        $user = $this->userQuery->getUserById($command->authorId);

        $post = new Post(
            id: $command->id,
            title: $command->title,
            content: $command->content,
            authorId: $user->id,
            createdAt: $this->clock->now(),
        );

        $this->postRepository->save($post);
    }
}
