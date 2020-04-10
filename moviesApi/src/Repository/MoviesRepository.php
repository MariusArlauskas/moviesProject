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

    public function findByApiIdWithUserStatuses($apiId, $userId, $limit, $offset) {
		$sql = '
			SELECT
				m.id,
				m.title,
				m.author,
				m.release_date as releaseDate,
				m.overview,
				m.poster_path as posterPath,
				m.original_title as originalTitle,
				m.rating,
				m.api_id as apiId,
				m.genres,
				m.most_popular as mostPopular,
				m.movie_id as movieId,
			   	umm.is_favorite as isFavorite,
			   	umm.relation_type_id as relationTypeId
			FROM
				movies m
			LEFT JOIN(
				SELECT
					*
				FROM
					users_movies um
				WHERE
					um.user_id = '.(int)$userId.'
			) umm
			ON
				m.movie_id = umm.movie_id
			WHERE 
				m.api_id = '.$apiId.'
			ORDER BY
				m.most_popular ASC
			LIMIT '.(int)$limit.' OFFSET '.(int)$offset.'
		';

		$conn = $this->getEntityManager()
			->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$ojbArr = [];
		foreach ($stmt->fetchAll() as $movie) {
			$ojbArr[] = new Movies($movie);
		}

		return $ojbArr;
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
