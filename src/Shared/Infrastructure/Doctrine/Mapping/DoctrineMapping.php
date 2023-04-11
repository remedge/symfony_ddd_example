<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\Mapping;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;

abstract class DoctrineMapping
{
    /**
     * @param class-string $className
     */
    public function __construct(
        private readonly string $className
    ) {
    }

    /**
     * @return class-string
     */
    public function getClass(): string
    {
        return $this->className;
    }

    abstract public function configure(ClassMetadataBuilder $builder): void;
}
