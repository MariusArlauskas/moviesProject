<?php

namespace App\Repository;

use App\Entity\Movies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

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

	/**
	 * @param int $apiId
	 * @param int $userId
	 * @param string $type
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 * @throws DBALException
	 */
    public function findByApiIdAndTypeWithUserStatuses($apiId, $userId, $type, $limit, $offset) {
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
			   	umm.relation_type_id as relationTypeId,
			    umm.user_rating as userRating
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
				m.api_id = '.(int)$apiId.' AND m.'.$type.' > '.(int)$offset.'
			ORDER BY
				m.most_popular ASC
			LIMIT '.(int)$limit.'
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

	/**
	 * @param int $apiId
	 * @param int $userId
	 * @return array
	 * @throws DBALException
	 */
	public function findUsersMovieList($apiId, $userId) {
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
				umm.movie_id as movieId,
			   	umm.is_favorite as isFavorite,
			   	umm.relation_type_id as relationTypeId,
			    umm.user_rating as userRating
			FROM
				(
				SELECT
					*
				FROM
					users_movies um
				WHERE
					um.user_id = '.(int)$userId.' AND um.api_id = '.(int)$apiId.'
				) umm
			LEFT JOIN
				movies m
			ON
				m.movie_id = umm.movie_id
			ORDER BY m.title ASC
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

	/**
	 * @param int $apiId
	 * @param string $type
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 * @throws DBALException
	 */
	public function findMostPopularByApi($apiId, $type, $limit, $offset) {
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
				m.movie_id as movieId
			FROM
				movies m
			WHERE 
				m.api_id = '.(int)$apiId.' AND m.'.$type.' > '.(int)$offset.'
			ORDER BY
				m.most_popular ASC
			LIMIT '.(int)$limit.'
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

	/**
	 * @param int $limit
	 * @param int $offset
	 * @param int $userId
	 * @param string $type
	 * @return array
	 * @throws DBALException
	 */
	public function findMostPopularInWeb($limit, $offset, $userId = 0, $type = 'M') {
		switch ($type) {
			case 'D':
				$dateInterval = '-1 day';
				break;
			default:
				$dateInterval = '-1 month';
				break;
		}
		$dateInterval = date("Y-m-d",strtotime($dateInterval));

		$selectUser = '';
		$leftJoinUser = '';
		if ($userId > 0) {
			$selectUser = ',
				umm.is_favorite as isFavorite,
				umm.relation_type_id as relationTypeId,
				umm.user_rating as userRating';
			$whereUser = '
			LEFT JOIN (
				SELECT
					*
				FROM
					users_movies t
				WHERE t.user_id = '.(int)$userId.'
				) umm ON umm.movie_id = m.movie_id';
		}

		$sql = '
			SELECT
				m.id,
				m.title,
				m.author,
				m.release_date AS releaseDate,
				m.overview,
				m.poster_path AS posterPath,
				m.original_title AS originalTitle,
				m.rating,
				m.api_id AS apiId,
				m.genres,
				m.most_popular AS mostPopular,
				COUNT(*) AS webPopularity,
			   	m.movie_id as movieId
			FROM
				users_movies um
			LEFT JOIN movies m ON
				m.movie_id = um.movie_id
			'.$leftJoinUser.'
			WHERE
				um.date_added > "'.$dateInterval.'"
			GROUP BY
				um.movie_id
			ORDER BY
				COUNT(*) DESC, m.title ASC
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
