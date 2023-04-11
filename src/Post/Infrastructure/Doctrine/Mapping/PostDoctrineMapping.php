<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Doctrine\Mapping;

use App\Post\Domain\Post;
use App\Shared\Infrastructure\Doctrine\Mapping\DoctrineMapping;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;

class PostDoctrineMapping extends DoctrineMapping
{
    public function __construct()
    {
        parent::__construct(Post::class);
    }

    public function configure(ClassMetadataBuilder $builder): void
    {
        $builder->setTable('posts');

        $builder->createField('id', 'uuid')
            ->unique()
            ->makePrimaryKey()
            ->build();

        $builder->createField('title', 'string')
            ->length(255)
            ->build();

        $builder->addField('content', 'text');

        $builder->addField('authorId', 'uuid');

        $builder->addField('createdAt', 'datetime_immutable');

        $builder->addField('updatedAt', 'datetime_immutable');
    }
}