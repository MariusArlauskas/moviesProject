<?php

namespace App\Controller\EntityController;

use App\Controller\InitSerializer;
use App\Entity\Messages;
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
		if (!$this->isGranted("ROLE_USER")) {
			throw new HttpException(Response::HTTP_FORBIDDEN, "Access denied!!");
		}

		// Assingning data from request and removing unnecessary symbols
		$parametersAsArray = [];
		if ($content = $request->getContent()) {
			$parametersAsArray = json_decode($content, true);
		}
		// Check if none of the data is missing
		if (isset($parametersAsArray['message'])) {
			$message = htmlspecialchars($parametersAsArray['message']);
		} else {
			return $this->serializer->response("Missing message!");
		}
		$userId = $this->getUser()->getId();
		var_dump($this->getUser());

		// Not required fields
		if (isset($parametersAsArray['parentId'])) {
			$parentId = htmlspecialchars(trim($parametersAsArray['parentId']));
		}

		// Creating user object
		$user = new Messages();
		$user->setUserId($userId);
		$user->setMessage($message);
		$user->setPostDate(new \DateTime());
		if (!empty($parentId)) {
			$user->setParentId($parentId);
		}

		// Get the Doctrine service and manager
		$em = $this->getDoctrine()->getManager();

		// Add user to Doctrine for saving
		$em->persist($user);

		// Save user
		$em->flush();

		return $this->serializer->response('Posted users message');
	}
}