<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class DeveloperRepository extends EntityRepository
{

    public function getDevelopers()
    {
        $qb = $this->createQueryBuilder('d')
            ->andWhere('d.deletedAt is null')
        ;

        return $qb->getQuery()->getResult();
    }

    public function resetDeveloperWeeklyCapacity()
    {
        $qb = $this->createQueryBuilder('d')
            ->update()
            ->set('d.weeklyCurrentCapacity', 'd.weeklyCapacity')
            ->andWhere('d.deletedAt is null')
        ;

        return $qb->getQuery()->execute();
    }

}