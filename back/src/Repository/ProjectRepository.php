<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Project>
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function findActiveProjects(): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.active = :active')
            ->setParameter('active', true)
            ->getQuery()
            ->getResult();
    }
}
