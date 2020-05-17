<?php

namespace App\Repository;

use App\Entity\FicheServiceEmployee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FicheServiceEmployee|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheServiceEmployee|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheServiceEmployee[]    findAll()
 * @method FicheServiceEmployee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheServiceEmployeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheServiceEmployee::class);
    }

    // /**
    //  * @return FicheServiceEmployee[] Returns an array of FicheServiceEmployee objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FicheServiceEmployee
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
