<?php

declare(strict_types=1);

namespace App\Comment\Presentation\Http\CreateComment;

class CreateCommentRequest
{
    public function __construct(
        public string $postId,
        public string $content,
        public string $authorId,
    ) {
    }
}
