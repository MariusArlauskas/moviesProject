<?php

namespace App\Controller\EntityController;

use App\Controller\InitSerializer;
use App\Entity\UserMoviesRelationTypes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
		$this->serializer = new InitSerializer();
	}

	/** Get top rated movies
	 * @Route("", name="movie_add_types_get", methods={"GET"})
	 */
	public function getAllAction() {
		$em = $this->getDoctrine()->getManager();
		$repMoviesAddTypes = $em->getRepository(UserMoviesRelationTypes::class);
		$moviesAddTypes = $repMoviesAddTypes->findAll();

		return $this->serializer->response($moviesAddTypes, 200, [], true);
	}
}