<?php

namespace App\Controller\EntityController;

use App\Entity\User;
use App\Entity\UserMovies;
use App\Entity\UserMoviesRelationTypes;
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
 * @Route("/lists/types")
 */
class UserMoviesRelationTypesController extends AbstractController
{
	protected $serializer;

	public function __construct()
	{
		$encoders = [new XmlEncoder(), new JsonEncoder()];
		$normalizers = [new ObjectNormalizer()];

		$this->serializer = new Serializer($normalizers, $encoders);
	}

	/** Get top rated movies
	 * @Route("", name="movie_add_types_get", methods={"GET"})
	 */
	public function getAllAction() {
		$em = $this->getDoctrine()->getManager();
		$repMoviesAddTypes = $em->getRepository(UserMoviesRelationTypes::class);
		$moviesAddTypes = $repMoviesAddTypes->findAll();

		return $this->response($moviesAddTypes, 200, [], true);
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