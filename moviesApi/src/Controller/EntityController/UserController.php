<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 27/02/2020
 * Time: 21:09
 */

namespace App\Controller\EntityController;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/users")
 */
class UserController extends AbstractController
{
    /**
     * @Route("", name="user_create", methods={"POST"})
     * @return JsonResponse
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
            isset($parametersAsArray['email'])) {
            $email = htmlspecialchars($parametersAsArray['email']);
            $name = htmlspecialchars(trim($parametersAsArray['name']));
            $password = htmlspecialchars(trim($parametersAsArray['password']));
        } else {
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
}