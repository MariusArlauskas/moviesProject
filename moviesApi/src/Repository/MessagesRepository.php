<?php

namespace App\Repository;

use App\Entity\Messages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

/**
 * @method Messages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Messages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Messages[]    findAll()
 * @method Messages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Messages::class);
    }

	/**
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 * @throws DBALException
	 */
	public function findMessagesSortedByDate($limit, $offset) {
		$sql = '
			SELECT
				msg.id,
				msg.message,
			    msg.post_date as postDate,
			    msg.parent_id as parentId,
				msg.shared_api_id as sharedApiId,
			    u.name as userName,
			    u.id as userId,
			   	u.profile_picture as userProfilePicture
			FROM
				messages msg
			LEFT JOIN
				users u ON
				msg.user_id = u.id
			WHERE 
				msg.parent_id IS NULL
			ORDER BY
				post_date DESC
			LIMIT '.(int)$limit.' OFFSET '.(int)$offset.'
		';

		$conn = $this->getEntityManager()
			->getConnection();
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}

    // /**
    //  * @return Messages[] Returns an array of Messages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Messages
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
