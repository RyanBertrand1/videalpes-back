<?php

namespace App\Repository;

use App\Entity\Launch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Launch|null find($id, $lockMode = null, $lockVersion = null)
 * @method Launch|null findOneBy(array $criteria, array $orderBy = null)
 * @method Launch[]    findAll()
 * @method Launch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LaunchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Launch::class);
    }

    // /**
    //  * @return LaunchById[] Returns an array of LaunchById objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LaunchById
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findById($value): ?Launch
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
