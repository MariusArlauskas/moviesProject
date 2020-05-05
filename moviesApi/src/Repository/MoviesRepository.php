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

    public function getMaxNumberByType($apiId, $type) {
    	$oType = $type;
		$type = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $type));		// oneTwo to one_two
		$sql = '
			SELECT
				MAX('.$type.') as '.$oType.'
			FROM
				movies
			WHERE 
				api_id = '.(int)$apiId.'
		';

		$conn = $this->getEntityManager()
			->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/**
	 * @param int $apiId
	 * @param int $userId
	 * @param string $type
	 * @param int $limit
	 * @param int $offset
	 * @param array $filter
	 * @return array
	 * @throws DBALException
	 */
    public function findByApiIdAndTypeWithUserStatuses($apiId, $userId, $type, $limit, $offset, $filter) {
		$type = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $type));		// oneTwo to one_two
		$setOffset = '';
		if (!empty($filter)) {
			$andWhere = '';
			foreach ($filter as $filt) {
				switch ($filt['name']) {
					case 'genre':
						if (empty($filt['sort'])) {
							break;
						}
						foreach ($filt['sort'] as $flt) {
							$andWhere .= ' AND m.genres LIKE \'%'.$flt.'%\'';
						}
						break;
					case 'like':
						if (isset($filt['sort']) && $filt['sort'] == "") {
							break;
						}
						$andWhere .= ' AND (umm.is_favorite=0 OR umm.is_favorite IS NULL)';
						break;
					case 'list':
						if (isset($filt['sort']) && $filt['sort'] == "") {
							break;
						}
						$andWhere .= ' AND (umm.relation_type_id IS NULL OR umm.relation_type_id=0)';
						break;
					case 'year':
						if (empty($filt['sort'])) {
							break;
						}
						$andWhere .= ' AND m.release_date > "'.$filt['sort'][0].'-01-01" AND m.release_date < "'.$filt['sort'][1].'-01-01"';
						break;
				}
			}
		}
		if (empty($andWhere)) {
			$andWhere = 'AND m.'.$type.' >= '.(int)$offset.' AND m.'.$type.' <= ('.(int)$offset.' + 20)';
		} else {
			$setOffset = 'OFFSET '.$offset;
			$andWhere = 'AND m.'.$type.' > 0'.$andWhere;
		}

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
				m.api_id = '.(int)$apiId.' '.$andWhere.'
			ORDER BY
				m.'.$type.' ASC
			LIMIT '.(int)$limit.' '.$setOffset.'
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
	 * @param array $filter
	 * @return array
	 * @throws DBALException
	 */
	public function findByApi($apiId, $type, $limit, $offset, $filter) {
		$type = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $type));		// oneTwo to one_two
		$setOffset = '';
		if (!empty($filter)) {
			$andWhere = '';
			foreach ($filter as $filt) {
				switch ($filt['name']) {
					case 'genre':
						if (empty($filt['sort'])) {
							break;
						}
						foreach ($filt['sort'] as $flt) {
							$andWhere .= ' AND m.genres LIKE \'%'.$flt.'%\'';
						}
						break;
					case 'year':
						if (empty($filt['sort'])) {
							break;
						}
						$andWhere .= ' AND m.release_date > "'.$filt['sort'][0].'-01-01" AND m.release_date < "'.$filt['sort'][1].'-01-01"';
						break;
				}
			}
		}
		if (empty($andWhere)) {
			$andWhere = 'AND m.'.$type.' >= '.(int)$offset.' AND m.'.$type.' <= ('.(int)$offset.' + 20)';
		} else {
			$setOffset = 'OFFSET '.$offset;
			$andWhere = 'AND m.'.$type.' > 0'.$andWhere;
		}

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
				m.api_id = '.(int)$apiId.' '.$andWhere.'
			ORDER BY
				m.'.$type.' ASC
			LIMIT '.(int)$limit.' '.$setOffset.'
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
				um.api_id AS apiId,
				m.genres,
				m.most_popular AS mostPopular,
				COUNT(um.id) AS webPopularity,
			   	um.movie_id as movieId
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
				COUNT(um.id) DESC, m.title ASC
			LIMIT '.(int)$limit.'  OFFSET '.(int)$offset.'
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
