<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 27/02/2020
 * Time: 21:09
 */

namespace App\Controller\EntityController;


use App\Entity\Movies;
use App\Entity\User;
use App\Entity\UserMovies;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/users")
 */
class UserController extends AbstractController
{
	protected $serializer;

	public function __construct()
	{
		$encoders = [new XmlEncoder(), new JsonEncoder()];
		$normalizers = [new ObjectNormalizer()];

		$this->serializer = new Serializer($normalizers, $encoders);
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
        	var_dump($parametersAsArray);
            return new JsonResponse("Missing data!", Response::HTTP_BAD_REQUEST);
        }

        // Validation
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findBy(['email' => $email]);
        if ($user) {
            return new JsonResponse('Email '.$email.' is already taken.', Response::HTTP_BAD_REQUEST);
        }

        // Creating user object
        $user = new User();
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

        return new JsonResponse('Saved new user with email - '.$user->getEmail(), Response::HTTP_OK);
    }

	/**
	 * @Route("/{id}", name="user_show_one", methods={"GET"}, requirements={"id"="\d+"})
	 * @return JsonResponse
	 */
	public function getOneAction($id)
	{
		// Finding user
		$repository = $this->getDoctrine()->getRepository(User::class);
		$user = $repository->find($id);
		if (!$user) {
			return new JsonResponse('No user found for id '.$id, Response::HTTP_NOT_FOUND);
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
		if (empty($userArray['profilePicture'])) {
			$userArray['profilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/defProfilePic.png';
		} else {
			$userArray['profilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$userArray['profilePicture'];
		}

		// Unset important or unnecessary values
		unset($userArray['password']);
		unset($userArray['roles']);

		return $this->response($userArray, 200, [], false, true);
	}

	/**
	 * @Route("/{userId}/{apiId}/movies/{movieId}/status/{relationType}", name="user_add_movie", methods={"POST"}, requirements={"userId"="\d+", "apiId"="\d+", "movieId"="\d+", "relationType"="\d+"})
	 * @return JsonResponse
	 */
	public function addMovieStatus($userId, $apiId, $movieId, $relationType) {
		$repository = $this->getDoctrine()->getRepository(UserMovies::class);
		$userMovies = $repository->findOneBy([
			'userId' => $userId,
			'apiId' => $apiId,
			'movieId' => $movieId,
		]);

		if (empty($userMovies)) {
			$userMovies = new UserMovies();
		}
		$userMovies->setUserId($userId);
		$userMovies->setApiId($apiId);
		$userMovies->setMovieId($movieId);
		if ($relationType == 0) {
			$userMovies->setIsFavorite(!$userMovies->getIsFavorite());
		} else {
			$userMovies->setRelationType($relationType);
		}

		// Get the Doctrine service and manager
		$em = $this->getDoctrine()->getManager();

		// Add user to Doctrine for saving
		$em->persist($userMovies);

		// Save user
		$em->flush();

		return $this->response('Added movie '.$movieId.' to user '.$userId);
	}

	/**
	 * Returns a JSON response
	 *
	 * @param array|string $data
	 * @param int $status
	 * @param array $headers
	 * @param bool $serialize Need serializing
	 * @param bool $url Escape slashes
	 * @return JsonResponse|Response
	 */
	public function response($data, $status = 200, $headers = [], $serialize = false, $url = false)
	{
		if ($serialize) {
			return new Response($this->serializer->serialize($data, 'json'), $status, $headers);
		} elseif ($url) {
			return new Response(json_encode($data, JSON_UNESCAPED_SLASHES), $status, $headers);
		}
		return new JsonResponse($data, $status, $headers);
	}

	protected function transformJsonBody(Request $request)
	{
		$data = json_decode($request->getContent(), true);

		if ($data === null) {
			return $request;
		}

		$request->request->replace($data);

		return $request;
	}
}