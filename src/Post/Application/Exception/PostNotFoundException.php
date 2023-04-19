<?php

declare(strict_types=1);

namespace App\Post\Application\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('Post not found');
    }
}
