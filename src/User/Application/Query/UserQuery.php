<?php

declare(strict_types=1);

namespace App\User\Application\Query;

use App\User\Application\DTO\UserDTO;
use App\User\Application\Exception\UserNotFoundException;
use App\User\Domain\UserRepository;
use Ramsey\Uuid\UuidInterface;

readonly class UserQuery
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function getById(UuidInterface $userId): UserDTO
    {
        $user = $this->userRepository->findById($userId);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return new UserDTO(
            id: $user->getId(),
            username: $user->getUsername(),
        );
    }
}
