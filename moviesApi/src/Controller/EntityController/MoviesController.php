<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 19/02/2020
 * Time: 21:26
 */

namespace App\Controller\EntityController;

use App\Controller\RemoteApi\TmdbApi;
use App\Repository\MoviesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class MoviesController
 * @package App\Controller
 * @Route("", name="movies_api")
 */
class MoviesController extends AbstractController
{
    /** Get top rated movies
     * @Route("/movies/page/{pageNumber}", name="movies_get", methods={"GET"})
     * @return JsonResponse|Response
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMovies($pageNumber){
        $movieApi = new TmdbApi();
        $movies = $movieApi->getMovies($pageNumber);
        return $this->response($movies);
    }

    /**
     * @Route("/movie/{movieName}", name="movie_get", methods={"GET"})
     * @param $movieName
     * @return JsonResponse|Response
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMovie($movieName){
//        $data = $moviesRepository->findAll();
        $movieApi = new TmdbApi();
        $movie = $movieApi->getMovie($movieName);
        return $this->response($movie);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param MoviesRepository $moviesRepository
     * @return JsonResponse
     * @throws \Exception
     * @Route("/movies", name="movies_add", methods={"POST"})
     */
    public function addMovies(Request $request, EntityManagerInterface $entityManager, MoviesRepository $moviesRepository){

        try{
            $request = $this->transformJsonBody($request);

            if (!$request || !$request->get('name') || !$request->request->get('description')){
                throw new \Exception();
            }

//            $movies = new Movies();
//            $entityManager->persist($movies); // TODO catch db error
//            $entityManager->flush();

            return $this->response('Movies added successfully', Response::HTTP_OK);

        }catch (\Exception $e){
            return $this->response($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }


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

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param MoviesRepository $moviesRepository
     * @param $id
     * @return JsonResponse
     * @Route("/movies/{id}", name="movies_put", methods={"PUT"})
     */
    public function updateMovies(Request $request, EntityManagerInterface $entityManager, MoviesRepository $moviesRepository, $id){

        try{
            $user = $moviesRepository->find($id);

            if (!$user){
                return $this->response('User not found', Response::HTTP_NOT_FOUND);
            }

//            $request = $this->transformJsonBody($request);

//            if (!$request || !$request->get('name') || !$request->request->get('description')){
//                throw new \Exception();
//            }
//
//            $user->setName($request->get('name'));
//            $user->setDescription($request->get('description'));
//            $entityManager->flush();// TODO catch db error

            return $this->response('User updated successfully', Response::HTTP_OK);

        }catch (\Exception $e){
            return $this->response('Data not valid', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }


    /**
     * @param MoviesRepository $moviesRepository
     * @param $id
     * @return JsonResponse
     * @Route("/movies/{id}", name="movies_delete", methods={"DELETE"})
     */
    public function deleteMovies(EntityManagerInterface $entityManager, MoviesRepository $moviesRepository, $id){
        $movies = $moviesRepository->find($id);

        if (!$movies){
            return $this->response('User not found', Response::HTTP_NOT_FOUND);
        }

//        $entityManager->remove($movies);// TODO catch db error
//        $entityManager->flush();

        return $this->response('Movies deleted successfully', Response::HTTP_OK);
    }





    /**
     * Returns a JSON response
     *
     * @param array|string $data
     * @param $status
     * @param array $headers
     * @param string $type  this | api
     * @return JsonResponse|Response
     */
    public function response($data, $status = 200, $headers = [])
    {
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