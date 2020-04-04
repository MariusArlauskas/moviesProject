<?php

namespace App\Repository;

use App\Entity\UserMoviesRelationTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserMoviesRelationTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserMoviesRelationTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserMoviesRelationTypes[]    findAll()
 * @method UserMoviesRelationTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserMoviesRelationTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserMoviesRelationTypes::class);
    }

    // /**
    //  * @return UserMoviesRelationTypes[] Returns an array of UserMoviesRelationTypes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserMoviesRelationTypes
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
