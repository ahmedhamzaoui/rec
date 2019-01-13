<?php

namespace ServiceBundle\Controller;

use ServiceBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * User controller.
 *
 */
class UsersController extends Controller
{
    /**
     * http://localhost/reclamation/web/app_dev.php/users/
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('ServiceBundle:Users')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($users);
        return new JsonResponse($formatted);
    }

    /**
     * inscription
     *
     */
    public function newAction(Request $request)
    {
        $username=$request->get("username");
        $email=$request->get("email");
        $password=$request->get("password");
        $em=$this->getDoctrine()->getManager();
        $userexist1 = $em->getRepository('ServiceBundle:Users')->findBy(array("email"=>$email));
        $userexist2 = $em->getRepository('ServiceBundle:Users')->findBy(array("username"=>$username));
        if ($userexist1!=null || $userexist2!=null){
            $msg=array("response"=>"erreur");
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($msg);
            return new JsonResponse($formatted);

        }

        $user = new Users();
        $user->setEmail($email);
        $user->setUsername($username);
        $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);

    }

    /**
     * http://localhost/reclamation/web/app_dev.php/users/2/show
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('ServiceBundle:Users')->find($id);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }

    /**
     * http://localhost/reclamation/web/app_dev.php/users/auth
     *
     */
    public function authAction(Request $request)
    {
        $username=$request->get("username");
        $email=$request->get("email");
        $password=$request->get("password");

        $em = $this->getDoctrine()->getManager();

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $user = $em->getRepository('ServiceBundle:Users')->findBy(array("password"=>$password,"email"=>$email));
        } else {
            $user = $em->getRepository('ServiceBundle:Users')->findBy(array("password"=>$password,"username"=>$username));
        }

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     *
     */
    public function profileAction(Request $request,$id)
    {

        $username=$request->get("username");
        $email=$request->get("email");

        $fullname=$request->get("fullname");
        $description=$request->get("description");

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('ServiceBundle:Users')->find($id);
        if ($username!=null) {
            $user->setUsername($username);
        }
        if ($email!=null){
            $user->setEmail($email);
        }
        if ($fullname!=null) {
            $user->setFullname($fullname);
        }
        if ($description!=null) {
            $user->setDescription($description);
        }
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);


    }

    /**
     * Deletes a user entity.
     *
     */
    public function deleteAction(Request $request, Users $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('users_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param Users $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Users $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('users_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
