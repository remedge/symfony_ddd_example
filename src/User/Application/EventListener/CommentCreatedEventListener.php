<?php

declare(strict_types=1);

namespace App\User\Application\EventListener;

use App\Comment\Application\Event\CommentCreatedEvent;
use App\User\Domain\UserRepository;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class CommentCreatedEventListener
{
    public function __construct(
        public UserRepository $userRepository,
    ) {
    }

    public function __invoke(CommentCreatedEvent $event): void
    {
        $user = $this->userRepository->findById($event->authorId);
        if ($user === null) {
            return;
        }

        // Send notification to user
        // ...
    }
}
