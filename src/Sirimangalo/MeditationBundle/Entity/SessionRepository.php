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

    public function findRecentDaysByUser($user)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT s
                FROM SirimangaloMeditationBundle:Session s
                WHERE
                    (
                        s.end > :daysAgo OR (
                            s.end IS NULL AND s.start > :daysAgo
                        )
                    ) AND
                    s.user = :user
                ORDER BY s.start DESC'
            )
            ->setParameter(
                'daysAgo',
                date('Y-m-d', strtotime('-10 days'))
            )
            ->setParameter('user', $user->getId())
            ->getResult();
    }

    public function findRecentWeeksByUser($user)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT s
                FROM SirimangaloMeditationBundle:Session s
                WHERE
                    (
                        s.end > :weeksAgo OR (
                            s.end IS NULL AND s.start > :weeksAgo
                        )
                    ) AND
                    s.user = :user
                ORDER BY s.start DESC'
            )
            ->setParameter(
                'weeksAgo',
                date('Y-m-d', strtotime('-10 weeks'))
            )
            ->setParameter('user', $user->getId())
            ->getResult();
    }

    public function findRecentMonthsByUser($user)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT s
                FROM SirimangaloMeditationBundle:Session s
                WHERE
                    (
                        s.end > :monthsAgo OR (
                            s.end IS NULL AND s.start > :monthsAgo
                        )
                    ) AND
                    s.user = :user
                ORDER BY s.start DESC'
            )
            ->setParameter(
                'monthsAgo',
                date('Y-m-d', strtotime('-10 months'))
            )
            ->setParameter('user', $user->getId())
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

    public function findMonthAgo()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT s
                FROM SirimangaloMeditationBundle:Session s
                WHERE
                    s.end > :monthAgo
                ORDER BY s.start DESC'
            )
            ->setParameter('monthAgo', date('Y-m-d', strtotime('-1 month')))
            ->getResult();
    }
}
