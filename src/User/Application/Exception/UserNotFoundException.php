<?php

declare(strict_types=1);

namespace App\User\Application\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('User not found');
    }
}
