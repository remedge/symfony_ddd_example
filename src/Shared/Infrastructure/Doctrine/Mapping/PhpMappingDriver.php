<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\Mapping;

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\MappingDriver as MappingDriverInterface;

class PhpMappingDriver implements MappingDriverInterface
{
    /**
     * @var array<class-string,DoctrineMapping>
     */
    private array $mappings;

    /**
     * @param iterable<DoctrineMapping> $mappings
     */
    public function __construct(iterable $mappings)
    {
        $mappingsMap = [];

        foreach ($mappings as $mapping) {
            $mappingsMap[$mapping->getClass()] = $mapping;
        }

        $this->mappings = $mappingsMap;
    }

    /**
     * @template T of object
     *
     * @param class-string<T>      $className
     * @param ClassMetadataInfo<T> $metadata
     *
     * @psalm-suppress MoreSpecificImplementedParamType because MappingDriver receives ClassMetadata but builder works with ClassMetadataInfo only
     */
    public function loadMetadataForClass(string $className, ClassMetadata $metadata): void
    {
        $this->mappings[$className]->configure(
            builder: new ClassMetadataBuilder(
                cm: $metadata,
            ),
        );
    }

    /**
     * @psalm-return list<class-string>
     *
     * @return array<int,class-string>
     */
    public function getAllClassNames(): array
    {
        return array_keys($this->mappings);
    }

    public function isTransient(string $className): bool
    {
        return !isset($this->mappings[$className]);
    }
}
