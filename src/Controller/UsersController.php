<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 19/02/2020
 * Time: 21:26
 */

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UsersController
 * @package App\Controller
 * @Route("/api", name="users_api")
 */
class UsersController extends AbstractController
{
    /**
     * @param UsersRepository $usersRepository
     * @return JsonResponse
     * @Route("/users", name="users", methods={"GET"})
     */
    public function getUsers(UsersRepository $usersRepository){
        $data = $usersRepository->findAll();
        return $this->response($data);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param UsersRepository $usersRepository
     * @return JsonResponse
     * @throws \Exception
     * @Route("/users", name="users_add", methods={"POST"})
     */
    public function addUsers(Request $request, EntityManagerInterface $entityManager, UsersRepository $usersRepository){

        try{
            $request = $this->transformJsonBody($request);

            if (!$request || !$request->get('name') || !$request->request->get('description')){
                throw new \Exception();
            }

//            $users = new Users();
//            $entityManager->persist($users); // TODO catch db error
//            $entityManager->flush();

            return $this->response('Users added successfully', Response::HTTP_OK);

        }catch (\Exception $e){
            return $this->response($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }


    /**
     * @param UsersRepository $usersRepository
     * @param $id
     * @return JsonResponse
     * @Route("/users/{id}", name="users_get", methods={"GET"})
     */
    public function getUser(UsersRepository $usersRepository, $id){
        $user = $usersRepository->find($id);

        if (!$user){
            return $this->response('User not found', Response::HTTP_NOT_FOUND);
        }
        return $this->response($user);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param UsersRepository $usersRepository
     * @param $id
     * @return JsonResponse
     * @Route("/users/{id}", name="users_put", methods={"PUT"})
     */
    public function updateUsers(Request $request, EntityManagerInterface $entityManager, UsersRepository $usersRepository, $id){

        try{
            $user = $usersRepository->find($id);

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
     * @param UsersRepository $usersRepository
     * @param $id
     * @return JsonResponse
     * @Route("/users/{id}", name="users_delete", methods={"DELETE"})
     */
    public function deleteUsers(EntityManagerInterface $entityManager, UsersRepository $usersRepository, $id){
        $users = $usersRepository->find($id);

        if (!$users){
            return $this->response('User not found', Response::HTTP_NOT_FOUND);
        }

//        $entityManager->remove($users);// TODO catch db error
//        $entityManager->flush();

        return $this->response('Users deleted successfully', Response::HTTP_OK);
    }





    /**
     * Returns a JSON response
     *
     * @param array|string $data
     * @param $status
     * @param array $headers
     * @return JsonResponse
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