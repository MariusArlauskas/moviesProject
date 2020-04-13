<?php

namespace App\Controller\EntityController;


use App\Controller\InitSerializer;
use App\Entity\Users;
use App\Entity\UsersMovies;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UsersController
 * @package App\Controller
 * @Route("/users")
 */
class UsersController extends AbstractController
{
	protected $serializer;

	public function __construct()
	{
		$this->serializer = new InitSerializer();
	}

	/**
	 * @Route("", name="user_create", methods={"POST"})
	 * @return JsonResponse
	 * @throws \Exception
	 */
    public function createAction(Request $request)
    {
        if ($this->isGranted("ROLE_USER")) {
            throw new HttpException(Response::HTTP_FORBIDDEN, "Access denied!!");
        }

        // Assingning data from request and removing unnecessary symbols
        $parametersAsArray = [];
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        // Check if none of the data is missing
        if (isset($parametersAsArray['password']) &&
            isset($parametersAsArray['name']) &&
            isset($parametersAsArray['birthDate']) &&
            isset($parametersAsArray['email'])) {
            $email = htmlspecialchars($parametersAsArray['email']);
            $name = htmlspecialchars(trim($parametersAsArray['name']));
            $birthDate = htmlspecialchars(trim($parametersAsArray['birthDate']));
            $password = htmlspecialchars(trim($parametersAsArray['password']));
        } else {
            return $this->serializer->response("Missing data!");
        }

        // Validation
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $user = $repository->findBy(['email' => $email]);
        if ($user) {
            return $this->serializer->response('Email '.$email.' is already taken.', Response::HTTP_BAD_REQUEST);
        }

        // Creating user object
        $user = new Users();
        $user->setEmail($email);
        $user->setName($name);
        $user->setRegisterDate(new \DateTime());
        $user->setBirthDate(\DateTime::createFromFormat('Y-m-d', $birthDate));
        $user->setRoles(['ROLE_USER']);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        // Get the Doctrine service and manager
        $em = $this->getDoctrine()->getManager();

        // Add user to Doctrine for saving
        $em->persist($user);

        // Save user
        $em->flush();

        return $this->serializer->response('Saved new user with email - '.$user->getEmail());
    }

	/**
	 * @Route("/{id}", name="user_show_one", methods={"GET"}, requirements={"id"="\d+"})
	 * @return JsonResponse
	 */
	public function getOneAction($id)
	{
		// Finding user
		$repository = $this->getDoctrine()->getRepository(Users::class);
		$user = $repository->find($id);
		if (!$user) {
			return $this->serializer->response('No user found for id '.$id, Response::HTTP_NOT_FOUND);
		}

		$userArray = $user->toArray();

		// Reformat values for front
		if (in_array('ROLE_ADMIN', $userArray['roles'])) {
			$userArray['role'] = "ROLE_ADMIN";
		}elseif (in_array('ROLE_USER', $userArray['roles'])){
			$userArray['role'] = "ROLE_USER";
		}else {
			$userArray['role'] = "ROLE_GUEST";
		}
		$userArray['birthDate'] = $user->getBirthDate()->format('Y-m-d');
		$userArray['registerDate'] = $user->getRegisterDate()->format('Y-m-d');
		if (empty($userArray['profilePicture'])) {
			$userArray['profilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/defProfilePic.png';
		} else {
			$userArray['profilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$userArray['profilePicture'];
		}

		// Unset important or unnecessary values
		unset($userArray['password']);
		unset($userArray['roles']);

		return $this->serializer->response($userArray, 200, [], false, true);
	}

	/**
	 * @Route("/{userId}/apis/{apiId}/movies/{movieId}/status/{relationType}", name="user_add_movie_to_list", methods={"POST"}, requirements={"userId"="\d+", "apiId"="\d+", "movieId"="\d+", "relationType"="\d+"})
	 * @return JsonResponse
	 */
	public function addMovieStatus($userId, $apiId, $movieId, $relationType) {
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository(UsersMovies::class);
		$userMovies = $repository->findOneBy([
			'userId' => $userId,
			'apiId' => $apiId,
			'movieId' => $movieId,
		]);

		// if not liked and remove from list or if only liked and remove like - remove from db aswell
		if ((!empty($userMovies) && $userMovies->getIsFavorite() == 0 && $userMovies->getRelationTypeId() == $relationType)
			|| (!empty($userMovies) && $userMovies->getIsFavorite() == 1 && empty($userMovies->getRelationTypeId()) && $relationType == 0)) {
			$em->remove($userMovies);
			$em->flush();
			return $this->serializer->response('Removed movie '.$movieId.' from user '.$userId);
		}

		if (empty($userMovies)) {
			$userMovies = new UsersMovies();
		}
		$userMovies->setUserId($userId);
		$userMovies->setApiId($apiId);
		$userMovies->setMovieId($movieId);
		if ($relationType == 0) {
			$userMovies->setIsFavorite(!$userMovies->getIsFavorite());
		} else {
			if ($userMovies->getRelationTypeId() == $relationType) {
				$userMovies->setRelationTypeId(0);
			} else {
				$userMovies->setRelationTypeId($relationType);
			}
		}

		// Get the Doctrine service and manager
		$em = $this->getDoctrine()->getManager();

		// Add user to Doctrine for saving
		$em->persist($userMovies);

		// Save user
		$em->flush();

		return $this->serializer->response('Set users '.$userId.' movie '.$movieId.' in list with status id '.$relationType);
	}

	/**
	 * @Route("/{userId}/apis/{apiId}/movies/{movieId}/rating/{rating}", name="user_add_movie_rating", methods={"POST"}, requirements={"userId"="\d+", "apiId"="\d+", "movieId"="\d+", "rating"="\d+"})
	 * @return JsonResponse
	 */
	public function addUsersRating($userId, $apiId, $movieId, $rating) {
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository(UsersMovies::class);
		$userMovie = $repository->findOneBy([
			'userId' => $userId,
			'apiId' => $apiId,
			'movieId' => $movieId,
		]);

		if (empty($userMovie)) {
			return $this->serializer->response('Cannot rate movies not in list', Response::HTTP_NOT_FOUND);
		}
		$userMovie->setUserRating($rating);

		$em->persist($userMovie);
		$em->flush();

		return $this->serializer->response('Rated movie - '.$rating);
	}

	/**
	 * @Route("/{id}/movies", name="user_movies_list", methods={"GET"}, requirements={"userId"="\d+"})
	 * @return Response
	 */
	public function getUsersMovies($id)
	{
		$result = $this->forward('App\Controller\EntityController\MoviesController::getUsersMovieList', [
			'userId' => $id,
		]);

		return $result;
	}
}