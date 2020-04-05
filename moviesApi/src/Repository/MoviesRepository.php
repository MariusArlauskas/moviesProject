<?php

namespace App\Repository;

use App\Entity\Movies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Movies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movies[]    findAll()
 * @method Movies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoviesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movies::class);
    }

//     /**
//      * @return Movies[] Returns an array of Movies objects
//      */
//    public function findByWithStatuses($value)
//    {
//        return $this->createQueryBuilder('m')
//			->add('select', 'm.*, mu.*')
//			->add('from', 'movies m')
//			->add('join', ' user_movies um ON m.movie_id = um.movie_id')
//			->add('where', ' um.api = '.$value.' and m.api_id = '.$value)
//			->getQuery()
//			->getResult()
//        ;
//    }

    /*
    public function findOneBySomeField($value): ?Movies
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
