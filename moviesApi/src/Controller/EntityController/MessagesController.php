<?php

namespace App\Controller\EntityController;

use App\Controller\InitSerializer;
use App\Controller\RemoteApi\TmdbApi;
use App\Entity\Messages;
use App\Entity\Movies;
use Doctrine\ORM\ORMException;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class MessagesController
 * @package App\Controller
 * @Route("/messages")
 */
class MessagesController extends AbstractController
{
	protected $serializer;

	public function __construct()
	{
		$this->serializer = new InitSerializer();
	}

	/**
	 * @IsGranted("ROLE_USER", statusCode=403, message="Access denied!!")
	 * @Route("", name="message_create", methods={"POST"})
	 * @param Request $request
	 * @return JsonResponse|Response
	 * @throws Exception
	 */
	public function createAction(Request $request)
	{
		// Assingning data from request and removing unnecessary symbols
		$parametersAsArray = [];
		if ($content = $request->getContent()) {
			$parametersAsArray = json_decode($content, true);
		}
		// Check if none of the data is missing
		if (isset($parametersAsArray['message'])) {
			$messageText = htmlspecialchars($parametersAsArray['message']);
		} else {
			return $this->serializer->response("Missing message!", Response::HTTP_BAD_REQUEST);
		}
		$userId = $this->getUser()->getId();

		// Not required fields
		if (isset($parametersAsArray['parentId'])) {
			$parentId = htmlspecialchars(trim($parametersAsArray['parentId']));
		}

		// Creating user object
		$message = new Messages();
		$message->setUserId($userId);
		$message->setMessage($messageText);
		$message->setPostDate(new \DateTime());
		if (!empty($parentId)) {
			$message->setParentId($parentId);
		}

		// Get the Doctrine service and manager
		$em = $this->getDoctrine()->getManager();

		// Add user to Doctrine for saving
		$em->persist($message);

		// Save user
		$em->flush();

		return $this->serializer->response($message, 200, [], false, false, true);
	}

	/**
	 * @Route("/{pageNumber}/{lastId}", name="messages_get", methods={"GET"}, requirements={"pageNumber"="\d+", "lastId"="\d+"})
	 */
	public function getAction($pageNumber, $lastId){
		$em = $this->getDoctrine()->getManager();
		$repMessages = $em->getRepository(Messages::class);

		if ($pageNumber == 0) {
			$messages = $repMessages->findMessagesSortedByDate(1, 0);
			if ($messages[0]['id'] == $lastId) {
				return $this->serializer->response([], 200);
			}
		} else {
			$messages = $repMessages->findMessagesSortedByDate(10, $pageNumber * 10 - 10 );
		}


		if (empty($messages)) {
			return $this->serializer->response([], 200);
		}

		foreach ($messages as $key => $message) {
			if (empty($message['userProfilePicture'])) {
				$messages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/defProfilePic.png';
			} else {
				$messages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$message['userProfilePicture'];
			}
		}

		return $this->serializer->response($messages, 200, [], false, true);
	}
}