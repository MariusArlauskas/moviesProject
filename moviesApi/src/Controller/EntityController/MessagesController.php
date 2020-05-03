<?php

namespace App\Controller\EntityController;

use App\Controller\InitSerializer;
use App\Entity\Messages;
use App\Entity\Users;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

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
	 * @Route("", name="message_create", methods={"POST"})
	 * @param Request $request
	 * @return JsonResponse|Response
	 * @throws Exception
	 */
	public function createAction(Request $request)
	{
		if (!$this->isGranted("ROLE_USER") || !$this->isGranted("ROLE_ADMIN")) {
			throw new HttpException(Response::HTTP_FORBIDDEN, "Access denied!!");
		}

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
		$repository = $this->getDoctrine()->getRepository(Users::class);
		$user = $repository->find($userId);
		if (empty($user)) {
			return $this->serializer->response('No user found for id '.$userId, Response::HTTP_NOT_FOUND);
		} elseif ($user->getChatBannedUntil() > new \DateTime())  {
			return $this->serializer->response('User is banned from chat!', Response::HTTP_FORBIDDEN);
		}

		// Not required fields
		if (!empty($parametersAsArray['parentId'])) {
			$parentId = htmlspecialchars(trim($parametersAsArray['parentId']));
		}
		if (!empty($parametersAsArray['movieId'])) {
			$movieId = htmlspecialchars(trim($parametersAsArray['movieId']));
		}

		// Creating user object
		$message = new Messages();
		$message->setUserId($userId);
		$message->setMessage($messageText);
		$message->setPostDate(new \DateTime());
		if (!empty($parentId)) {
			$message->setParentId($parentId);
		}
		if (!empty($movieId)) {
			$message->setMovieId($movieId);
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
	 * @Route("/{elementNumber}/{lastId}", name="messages_get", methods={"GET"}, requirements={"pageNumber"="\d+", "lastId"="\d+"})
	 * @param int $elementNumber
	 * @param int $lastId
	 * @return JsonResponse|Response
	 */
	public function getAllAction($elementNumber, $lastId){
		$em = $this->getDoctrine()->getManager();
		$repMessages = $em->getRepository(Messages::class);

		if ($elementNumber == 0) {
			$messages = $repMessages->findMessagesSortedByDate(1, 0);
			if ($messages[0]['id'] == $lastId) {
				return $this->serializer->response([], 200);
			}
		} else {
			$elementNumber -= 1;
			$messages = $repMessages->findMessagesSortedByDate(10, $elementNumber );
		}

		if (empty($messages)) {
			return $this->serializer->response([], 200);
		}

		$childMessages = [];
		foreach ($messages as $message) {
			$childMessages[] = $message['id'];		// First put in parents ids for search
		}
		$childMessages = $repMessages->findMessagesCommentsSortedByDate($childMessages);

		foreach ($childMessages as $key => $message) {
			if (empty($message['userProfilePicture'])) {
				$childMessages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/defProfilePic.png';
			} else {
				$childMessages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/'.$message['userProfilePicture'];
			}
		}
		foreach ($messages as $key => $message) {
			$messages[$key]['children'] = [];
			if (empty($message['userProfilePicture'])) {
				$messages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/defProfilePic.png';
			} else {
				$messages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/'.$message['userProfilePicture'];
			}

			if (!empty($childMessages)) {
				foreach ($childMessages as $childMessage) {
					if ($childMessage['parentId'] == $message['id']) {
						$messages[$key]['children'][] = $childMessage;
					}
				}
			}
		}

		return $this->serializer->response($messages, 200, [], false, true);
	}

	public function getAllUsersMessages($userId, $elementNumber){
		$em = $this->getDoctrine()->getManager();
		$repMessages = $em->getRepository(Messages::class);

		$messages = $repMessages->findMessagesSortedByDate(10, $elementNumber, $userId );

		if (empty($messages)) {
			return $this->serializer->response([], 200);
		}

		$childMessages = [];
		foreach ($messages as $message) {
			$childMessages[] = $message['id'];		// First put in parents ids for search
		}
		$childMessages = $repMessages->findMessagesCommentsSortedByDate($childMessages);

		foreach ($childMessages as $key => $message) {
			if (empty($message['userProfilePicture'])) {
				$childMessages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/defProfilePic.png';
			} else {
				$childMessages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/'.$message['userProfilePicture'];
			}
		}
		foreach ($messages as $key => $message) {
			$messages[$key]['children'] = [];
			if (empty($message['userProfilePicture'])) {
				$messages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/defProfilePic.png';
			} else {
				$messages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/'.$message['userProfilePicture'];
			}

			if (!empty($childMessages)) {
				foreach ($childMessages as $childMessage) {
					if ($childMessage['parentId'] == $message['id']) {
						$messages[$key]['children'][] = $childMessage;
					}
				}
			}
		}

		return $this->serializer->response($messages, 200, [], false, true);
	}

	public function getAllMovieMessages($movieId, $elementNumber){
		$em = $this->getDoctrine()->getManager();
		$repMessages = $em->getRepository(Messages::class);

		$messages = $repMessages->findMovieMessagesSortedByDate(10, $elementNumber, $movieId );

		if (empty($messages)) {
			return $this->serializer->response([], 200);
		}

		$childMessages = [];
		foreach ($messages as $message) {
			$childMessages[] = $message['id'];		// First put in parents ids for search
		}
		$childMessages = $repMessages->findMovieMessagesCommentsSortedByDate($childMessages);

		foreach ($childMessages as $key => $message) {
			if (empty($message['userProfilePicture'])) {
				$childMessages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/defProfilePic.png';
			} else {
				$childMessages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/'.$message['userProfilePicture'];
			}
		}
		foreach ($messages as $key => $message) {
			$messages[$key]['children'] = [];
			if (empty($message['userProfilePicture'])) {
				$messages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/defProfilePic.png';
			} else {
				$messages[$key]['userProfilePicture'] = 'http://'.$_SERVER['HTTP_HOST'].'/Files/'.$message['userProfilePicture'];
			}

			if (!empty($childMessages)) {
				foreach ($childMessages as $childMessage) {
					if ($childMessage['parentId'] == $message['id']) {
						$messages[$key]['children'][] = $childMessage;
					}
				}
			}
		}

		return $this->serializer->response($messages, 200, [], false, true);
	}
}