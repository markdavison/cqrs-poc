<?php

namespace App\Repository;

use App\Entity\IpCase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IpCase|null find($id, $lockMode = null, $lockVersion = null)
 * @method IpCase|null findOneBy(array $criteria, array $orderBy = null)
 * @method IpCase[]    findAll()
 * @method IpCase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IpCaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IpCase::class);
    }

    // /**
    //  * @return IpCase[] Returns an array of IpCase objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IpCase
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
