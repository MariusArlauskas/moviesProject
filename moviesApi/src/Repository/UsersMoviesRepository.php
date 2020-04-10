<?php

namespace App\Repository;

use App\Entity\UsersMovies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UsersMovies|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersMovies|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersMovies[]    findAll()
 * @method UsersMovies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersMoviesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersMovies::class);
    }

    // /**
    //  * @return UserMovies[] Returns an array of UserMovies objects
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
    public function findOneBySomeField($value): ?UserMovies
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
