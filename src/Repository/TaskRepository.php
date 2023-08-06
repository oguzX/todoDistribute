<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{

    public function getTaskHash()
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t.hash')
            ->andWhere('t.developer is not null')
        ;

        return $qb->getQuery()->getSingleColumnResult();
    }

    public function getLastWeek()
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t.week')
            ->orderBy('t.week', 'desc')
            ->setMaxResults(1)
        ;

        return $qb->getQuery()->getSingleColumnResult()[0] ?? 0;
    }
}