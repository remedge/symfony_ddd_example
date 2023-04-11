<?php

declare(strict_types=1);

namespace App\User\Presentation\Http;

use App\User\Application\Query\UserQuery;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

readonly class GetUserController
{
    public function __construct(
        private UserQuery $userQuery,
    ) {
    }

    #[Route(path: '/users/{userId}', methods: [Request::METHOD_GET])]
    public function __invoke(
        UuidInterface $userId,
    ): JsonResponse {
        $user = $this->userQuery->getUserById($userId);

        return new JsonResponse(new UserResponse(
            id: $user->id->toString(),
            username: $user->username,
        ));
    }
}
