<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 19/02/2020
 * Time: 21:26
 */

namespace App\Controller\EntityController;

use App\Controller\InitSerializer;
use App\Controller\RemoteApi\TmdbApi;
use App\Entity\Movies;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class MoviesController
 * @package App\Controller
 * @Route("/movies", name="movies_api")
 */
class MoviesController extends AbstractController
{
	protected $serializer;

	public function __construct()
	{
		$this->serializer = new InitSerializer();
	}

	/** Get top rated movies
	 * @Route("/page/{pageNumber}/user/{userId}", name="movies_get", methods={"GET"}, requirements={"userId"="\d+", "pageNumber"="\d+"})
	 * @return JsonResponse|Response
	 * @throws ClientExceptionInterface
	 * @throws RedirectionExceptionInterface
	 * @throws ServerExceptionInterface
	 * @throws TransportExceptionInterface
	 */
	public function getMovies($pageNumber, $userId){
		$apiId = 1;
		$em = $this->getDoctrine()->getManager();
		$repMovies = $em->getRepository(Movies::class);
		$movies = $repMovies->findByApiIdWithUserStatuses($apiId, $userId, 20, $pageNumber * 20 - 20 );

		if (empty($movies)) { 	// Fetch from remote api
			$movieApi = new TmdbApi($em);
			$movies = $movieApi->getPopularMovies($pageNumber, $pageNumber * 20 - 20);
			foreach ($movies as $movie) {
				// Add movie to Doctrine so that it can be saved
				$em->persist($movie);
			}
			// Save movies
			$em->flush();

			// Now check again to join with users liked movies list
			$movies = $repMovies->findByApiIdWithUserStatuses($apiId, $userId, 20, $pageNumber * 20 - 20 );
		}

		foreach ($movies as $key => $movie) {	// Change genres to string
			preg_match_all('/"(.*?)"/', $movie['genres'], $temp);
			array_shift($temp);
			$movies[$key]['genres'] = join(', ', $temp[0]);
		}
		return $this->serializer->response($movies, 200, [], true);
	}

	/**
	 * @Route("/{id}", name="movie_show_one", methods={"GET"}, requirements={"id"="\d+"})
	 * @return JsonResponse
	 */
	public function getOneFromDbAction($id)
	{
		// Finding user
		$repository = $this->getDoctrine()->getRepository(Movies::class);
		$movie = $repository->find($id);
		if (!$movie) {
			return new JsonResponse('No movie found for id '.$id, Response::HTTP_NOT_FOUND);
		}

		$movieArray = $movie->toArray();
		$movieArray['releaseDate'] = $movie->getReleaseDate()->format('Y-m-d');
		unset($movieArray['usersList']);

		return $this->serializer->response($movieArray, 200, [], true);
	}
//
//    /**
//     * @param Request $request
//     * @param EntityManagerInterface $entityManager
//     * @param MoviesRepository $moviesRepository
//     * @return JsonResponse
//     * @throws \Exception
//     * @Route("/movies", name="movies_add", methods={"POST"})
//     */
//    public function addMovies(Request $request, EntityManagerInterface $entityManager, MoviesRepository $moviesRepository){
//
//        try{
//            $request = $this->transformJsonBody($request);
//
//            if (!$request || !$request->get('name') || !$request->request->get('description')){
//                throw new \Exception();
//            }
//
////            $movies = new Movies();
////            $entityManager->persist($movies); // TODO catch db error
////            $entityManager->flush();
//
//            return $this->response('Movies added successfully', Response::HTTP_OK);
//
//        }catch (\Exception $e){
//            return $this->response($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
//        }
//
//    }


//    /**
//     * @param MoviesRepository $moviesRepository
//     * @param $id
//     * @return JsonResponse
//     * @Route("/movies/{id}", name="movies_get", methods={"GET"})
//     */
//    public function getUser(MoviesRepository $moviesRepository, $id){
//        $user = $moviesRepository->find($id);
//
//        if (!$user){
//            return $this->response('User not found', Response::HTTP_NOT_FOUND);
//        }
//        return $this->response($user);
//    }

//    /**
//     * @param Request $request
//     * @param EntityManagerInterface $entityManager
//     * @param MoviesRepository $moviesRepository
//     * @param $id
//     * @return JsonResponse
//     * @Route("/movies/{id}", name="movies_put", methods={"PUT"})
//     */
//    public function updateMovies(Request $request, EntityManagerInterface $entityManager, MoviesRepository $moviesRepository, $id){
//
//        try{
//            $user = $moviesRepository->find($id);
//
//            if (!$user){
//                return $this->response('User not found', Response::HTTP_NOT_FOUND);
//            }
//
////            $request = $this->transformJsonBody($request);
//
////            if (!$request || !$request->get('name') || !$request->request->get('description')){
////                throw new \Exception();
////            }
////
////            $user->setName($request->get('name'));
////            $user->setDescription($request->get('description'));
////            $entityManager->flush();// TODO catch db error
//
//            return $this->response('User updated successfully', Response::HTTP_OK);
//
//        }catch (\Exception $e){
//            return $this->response('Data not valid', Response::HTTP_UNPROCESSABLE_ENTITY);
//        }
//
//    }
//
//
//    /**
//     * @param MoviesRepository $moviesRepository
//     * @param $id
//     * @return JsonResponse
//     * @Route("/movies/{id}", name="movies_delete", methods={"DELETE"})
//     */
//    public function deleteMovies(EntityManagerInterface $entityManager, MoviesRepository $moviesRepository, $id){
//        $movies = $moviesRepository->find($id);
//
//        if (!$movies){
//            return $this->response('User not found', Response::HTTP_NOT_FOUND);
//        }
//
////        $entityManager->remove($movies);// TODO catch db error
////        $entityManager->flush();
//
//        return $this->response('Movies deleted successfully', Response::HTTP_OK);
//    }
}