<?php

namespace App\Repository;

use App\Entity\UsersMoviesRelationTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UsersMoviesRelationTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersMoviesRelationTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersMoviesRelationTypes[]    findAll()
 * @method UsersMoviesRelationTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersMoviesRelationTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersMoviesRelationTypes::class);
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
