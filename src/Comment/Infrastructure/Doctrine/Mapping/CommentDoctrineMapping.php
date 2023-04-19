<?php

declare(strict_types=1);

namespace App\Comment\Infrastructure\Doctrine\Mapping;

use App\Comment\Domain\Comment;
use App\Shared\Infrastructure\Doctrine\Mapping\DoctrineMapping;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;

class CommentDoctrineMapping extends DoctrineMapping
{
    public function __construct()
    {
        parent::__construct(Comment::class);
    }

    public function configure(ClassMetadataBuilder $builder): void
    {
        $builder->setTable('comments');

        $builder->createField('id', 'uuid')
            ->unique()
            ->makePrimaryKey()
            ->build();

        $builder->addField('postId', 'uuid');

        $builder->addField('content', 'text');

        $builder->addField('authorId', 'uuid');

        $builder->addField('createdAt', 'datetime_immutable');
    }
}
