<?php

declare(strict_types=1);

namespace App\Comment\Domain;

interface CommentRepository
{
    public function save(Comment $comment): void;
}
