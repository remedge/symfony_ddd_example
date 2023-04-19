<?php

declare(strict_types=1);

namespace App\Post\Application\Query;

use App\Post\Application\DTO\PostDTO;
use App\Post\Application\Exception\PostNotFoundException;
use App\Post\Domain\PostRepository;
use Ramsey\Uuid\UuidInterface;

readonly class PostQuery
{
    public function __construct(
        private PostRepository $postRepository,
    ) {
    }

    public function getById(UuidInterface $id): PostDTO
    {
        $post = $this->postRepository->findById($id);

        if ($post === null) {
            throw new PostNotFoundException();
        }

        return new PostDTO(
            id: $post->getId(),
            title: $post->getTitle(),
            content: $post->getContent(),
            authorId: $post->getAuthorId(),
            createdAt: $post->getCreatedAt(),
        );
    }
}
