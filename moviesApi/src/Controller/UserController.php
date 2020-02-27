<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 27/02/2020
 * Time: 21:09
 */

namespace App\Controller;


use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/api/users")
 */
class UserController extends AbstractController
{
    /** TODO add adapter to register controller
     * @Route("/register", name="user_create", methods={"POST"})
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
//        if (isset($parametersAsArray['username']) &&
//            isset($parametersAsArray['password']) &&
//            isset($parametersAsArray['email']))
//        {
            $email = htmlspecialchars($parametersAsArray['email']);
            $password = htmlspecialchars(trim($parametersAsArray['password']));
//            $email = htmlspecialchars($parametersAsArray['email']);
//        }else{
//            return new JsonResponse("Missing data!", Response::HTTP_BAD_REQUEST);
//        }
//
//        // Validation
//        $repository = $this->getDoctrine()->getRepository(User::class);
//        $user = $repository->findBy(['username' => $username]);
//        if ($user) {
//            return new JsonResponse('Username '.$username.' is already taken.', Response::HTTP_BAD_REQUEST);
//        }
        var_dump($parametersAsArray);
        // Creating user object
        $user = new User();
        $user->setEmail($email);
        $user->setRoles(['ROLE_USER']);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
//        $user->setUsername($username);
//        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
//        $user->setEmail($email);
//        $user->setRoles(['ROLE_USER']);

        // Get the Doctrine service and manager
        $em = $this->getDoctrine()->getManager();

        // Add user to Doctrine so that it can be saved
        $em->persist($user);

        // Save user
        $em->flush();

        return new JsonResponse('Saved new user - '.$user->getEmail(), Response::HTTP_OK);
    }
}