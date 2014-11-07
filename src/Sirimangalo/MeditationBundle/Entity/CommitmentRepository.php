<?php

namespace Sirimangalo\MeditationBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CommitmentRepository extends EntityRepository
{
    public function findMine($userId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c
                FROM SirimangaloMeditationBundle:Commitment c
                INNER JOIN c.userCommitments uc
                WHERE uc.user = :user'
            )
            ->setParameter('user', $userId)
            ->getResult();
    }

    public function findOthers($userId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c
                FROM SirimangaloMeditationBundle:Commitment c
                LEFT JOIN c.userCommitments uc
                WHERE uc.user != :user OR uc.user IS NULL'
            )
            ->setParameter('user', $userId)
            ->getResult();
    }
}
