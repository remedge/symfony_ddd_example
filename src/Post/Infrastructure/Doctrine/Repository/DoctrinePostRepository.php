<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Doctrine\Repository;

use App\Post\Domain\Post;
use App\Post\Domain\PostRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

/**
 * @extends ServiceEntityRepository<Post>
 */
class DoctrinePostRepository extends ServiceEntityRepository implements PostRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function save(Post $post): void
    {
        $this->_em->persist($post);
        $this->_em->flush();
    }

    public function findById(UuidInterface $id): ?Post
    {
        return $this->find($id);
    }
}
