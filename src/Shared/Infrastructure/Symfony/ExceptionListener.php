<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony;

use App\User\Application\Exception\UserNotFoundException;
use Fusonic\HttpKernelExtensions\Exception\ConstraintViolationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

class ExceptionListener
{
    /**
     * @var array<string>
     */
    private array $notFoundExceptions = [
        UserNotFoundException::class,
    ];

    /**
     * @var array<string>
     */
    private array $badRequestExceptions = [
        ConstraintViolationException::class,
    ];

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if ($exception instanceof HandlerFailedException && ($previousException = $exception->getPrevious()) !== null) {
            $exception = $previousException;
        }

        $response = new JsonResponse(
            data: [
                'message' => $exception->getMessage(),
            ],
            status: Response::HTTP_INTERNAL_SERVER_ERROR,
        );

        if (in_array(get_class($exception), $this->notFoundExceptions, true)) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        if (in_array(get_class($exception), $this->badRequestExceptions, true)) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $event->setResponse($response);
    }
}
