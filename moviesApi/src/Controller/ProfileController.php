<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 18/11/2019
 * Time: 16:49
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ProfileController
 * @package App\Controller\Api
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
	protected $serializer;

	public function __construct()
	{
		$encoders = [new XmlEncoder(), new JsonEncoder()];
		$normalizers = [new ObjectNormalizer()];

		$this->serializer = new Serializer($normalizers, $encoders);
	}

    /**
     * @IsGranted("ROLE_USER", statusCode=403, message="Access denied!!")
     * @Route("", name="current_user_profile_data", methods={"GET"})
     * @return Response
     */
    public function getSelfAction()
    {
        $userId = $this->getUser()->getId();

        return $this->getAction($userId);
    }

	/**
	 * @Route("/{id}", name="user_profile_data", methods={"GET"})
	 * @return Response
	 */
	public function getAction($id)
	{
		$user = $this->getUser();

		$result = $this->forward('App\Controller\EntityController\UserController::getOneAction', [
			'id' => $id,
		]);

		return $result;
	}

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        $result = new JsonResponse("Logged out!!", Response::HTTP_OK);

        $result->headers->clearCookie('BEARER');
        $result->headers->clearCookie('REFRESH_TOKEN');

        session_unset();
        return $result;
    }
//
//    /**
//     * @Route("/role", name="show_role", methods={"GET"})
//     * @return JsonResponse
//     */
//    public function getRoleAction()
//    {
//        if ($this->isGranted("ROLE_ADMIN")) {
//            $data = "ROLE_ADMIN";
//        }elseif ($this->isGranted("ROLE_USER")){
//            $data = "ROLE_USER";
//        }else {
//            $data = "ROLE_NONE";
//        }
//
//        return new JsonResponse($data);
//    }
//
//    /**
//     * @IsGranted("ROLE_USER", statusCode=403, message="Access denied!!")
//     * @Route("/movies", name="profile_add_movie", methods={"POST"}, requirements={"movieId"="\d+"})
//     * @return JsonResponse
//     */
//    public function addMovie(Request $request)
//    {
//        $result = $this->forward('App\Controller\Api\User\UserMoviesController::addAction', [
//            'id' => $this->getUser()->getId(),
//            'request' => $request,
//        ]);
//
//        return $result;
//    }
//
//    /**
//     * @IsGranted("ROLE_USER", statusCode=403, message="Access denied!!")
//     * @Route("/movies", name="profile_show_movies", methods={"GET"})
//     * @return JsonResponse
//     */
//    public function showMovies(Request $request)
//    {
//        $result = $this->forward('App\Controller\Api\User\UserMoviesController::getAllAction', [
//            'id' => $this->getUser()->getId(),
//            'request' => $request,
//        ]);
//
//        return $result;
//    }
//
//    /**
//     * @IsGranted("ROLE_USER", statusCode=403, message="Access denied!!")
//     * @Route("/movies/{movieId}", name="profile_show_one_movie", methods={"GET"}, requirements={"movieId"="\d+"})
//     * @return JsonResponse
//     */
//    public function showOneMovie($movieId)
//    {
//        $result = $this->forward('App\Controller\Api\User\UserMoviesController::getOneAction', [
//            'id' => $this->getUser()->getId(),
//            'movieId' => $movieId,
//        ]);
//
//        return $result;
//    }
//
//    /**
//     * @IsGranted("ROLE_USER", statusCode=403, message="Access denied!!")
//     * @Route("/movies/{movieId}", name="profile_delete_movie", methods={"DELETE"}, requirements={"movieId"="\d+"})
//     * @return JsonResponse
//     */
//    public function deleteMovie($movieId)
//    {
//        $result = $this->forward('App\Controller\Api\User\UserMoviesController::deleteAction', [
//            'id' => $this->getUser()->getId(),
//            'movieId' => $movieId,
//        ]);
//
//        return $result;
//    }
//
//    /**
//     * @IsGranted("ROLE_USER", statusCode=403, message="Access denied!!")
//     * @Route("", name="edit_profile", methods={"PUT"})
//     * @return JsonResponse
//     */
//    public function editAction(Request $request)
//    {
//        $result = $this->forward('App\Controller\Api\User\UserController::updateAction', [
//            'id' => $this->getUser()->getId(),
//            'request' => $request,
//        ]);
//
//        if (!empty(json_decode($request->getContent(), true)['username'])){
//            $result->headers->clearCookie('BEARER');
//            $result->headers->clearCookie('REFRESH_TOKEN');
//
//            $result = $result->setContent(trim("\"" . $result->getContent(), "\"") . ". Please relogin \"");
//        }
//
//        return $result;
//    }
//
//    /**
//     * @IsGranted("ROLE_USER", statusCode=403, message="Access denied!!")
//     * @Route("", name="delete_profile", methods={"DELETE"})
//     * @return JsonResponse
//     */
//    public function deleteAction(Request $request)
//    {
//        $result = $this->forward('App\Controller\Api\User\UserController::deleteAction', [
//            'id' => $this->getUser()->getId(),
//            'request' => $request,
//        ]);
//
//        $result->headers->clearCookie('BEARER');
//        $result->headers->clearCookie('REFRESH_TOKEN');
//
//        return $result;
//    }

	/**
	 * Returns a JSON response
	 *
	 * @param array|string $data
	 * @param int $status
	 * @param array $headers
	 * @param bool $serialize Need serializing?
	 * @return JsonResponse|Response
	 */
	public function response($data, $status = 200, $headers = [], $serialize = false)
	{
		if ($serialize) {
			return new Response($this->serializer->serialize($data, 'json'), $status, $headers);
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