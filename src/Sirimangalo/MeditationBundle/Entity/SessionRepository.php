<?php

namespace Sirimangalo\MeditationBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SessionRepository extends EntityRepository
{
    public function findRecent()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT s
                FROM SirimangaloMeditationBundle:Session s
                WHERE
                    s.end > :hourAgo OR (
                        s.end IS NULL AND s.start > :hourAgo
                    )
                ORDER BY s.start DESC'
            )
            ->setParameter('hourAgo', date('Y-m-d', strtotime('-1 hour')))
            ->getResult();
    }

    public function findMineRunning($userId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT s
                 FROM SirimangaloMeditationBundle:Session s
                 WHERE
                     s.end IS NULL AND
                     s.user = :userId'
            )
           ->setParameter('userId', $userId)
           ->getResult();
    }
}
