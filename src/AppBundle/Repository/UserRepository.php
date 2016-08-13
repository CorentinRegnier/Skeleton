<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 *
 * @package AppBundle\Repository
 */
class UserRepository extends EntityRepository
{
    /**
     * @param $term
     *
     * @return array
     */
    public function findLikeUsername($term)
    {
        $builder = $this->createQueryBuilder('user')
            ->where('user.username LIKE :term')
            ->setParameter('term', '%'.$term.'%')
            ->orderBy('user.username', "ASC")
            ->setMaxResults(10);

        return $builder->getQuery()->getResult();
    }
}
