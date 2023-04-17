<?php

declare(strict_types=1);

namespace App\Post\Presentation\Http\CreatePost;

readonly class CreatePostRequest
{
    public function __construct(
        public string $title,
        public string $content,
        public string $authorId,
    ) {
    }
}
