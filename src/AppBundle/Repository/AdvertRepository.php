<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * AdvertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertRepository extends EntityRepository
{

    public function findFromLastDays(int $days = 1)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT b FROM AppBundle:Advert b WHERE b.createDate > :date ORDER BY b.createDate DESC')
            ->setParameter(':date', new \DateTime('now - ' . $days . ' days'))
            ->setMaxResults(3)
            ->getResult();
    }

    public function search(string $expression)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT b FROM AppBundle:Advert b WHERE b.title LIKE :expression')
            ->setParameter('expression', '%' . $expression .'%')
            ->getResult();
    }

}
