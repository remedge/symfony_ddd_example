<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Http;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class UuidValueResolver implements ValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return !$argument->isVariadic() && is_a((string) $argument->getType(), UuidInterface::class, true);
    }

    /**
     * @return array<UuidInterface>
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if (!$this->supports($request, $argument)) {
            return [];
        }

        return [Uuid::fromString((string) $request->attributes->get($argument->getName()))];
    }
}
