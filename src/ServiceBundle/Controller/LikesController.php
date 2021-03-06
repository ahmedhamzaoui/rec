<?php

namespace ServiceBundle\Controller;

use ServiceBundle\Entity\Likes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Count;

/**
 * Like controller.
 *
 * @Route("likes")
 */
class LikesController extends Controller
{
    /**
     * Lists all like entities.
     *
     * @Route("/", name="likes_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $likes = $em->getRepository('ServiceBundle:Likes')->findOneBy(array("userid"=>$request->get("userid"),"idpost"=>$request->get("idpost")));
        if($likes!=null){
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($likes->getIdpost());
            return new JsonResponse($formatted);
        }
        else{
            $s="";
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($s);
            return new JsonResponse($formatted);
        }

    }

    /**
     * Lists all like entities.
     *
     * @Route("/nb", name="likes_nb")
     * @Method({"GET", "POST"})
     */
    public function nbAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $likes = $em->getRepository('ServiceBundle:Likes')->findBy(array("idpost"=>$request->get("idpost")));
        $x=0;
        foreach ($likes as $like){
            $x++;
        }
        if($likes!=null){
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($x);
            return new JsonResponse($formatted);
        }
        else{
            $s=0;
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($s);
            return new JsonResponse($formatted);
        }

    }

    /**
     * Creates a new like entity.
     *
     * @Route("/new", name="likes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {          $userid=$request->get("userid");
        $idpost=$request->get("idpost");

        $em = $this->getDoctrine()->getManager();
        $likes=$em->getRepository("ServiceBundle:Likes")->findOneBy(array("idpost"=>$idpost,"userid"=>$userid));


        if ($likes==null) {
            $likes = new Likes();
            $likes->setUserid($userid);
            $likes->setIdpost($idpost);
            $em->persist($likes);
            $em->flush();
        }else if ($likes!=null){
            $em->remove($likes);
            $em->flush();

        }

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($likes->getId());
        return new JsonResponse($formatted);

    }

    /**
     * Finds and displays a like entity.
     *
     * @Route("/{id}", name="likes_show")
     * @Method("GET")
     */
    public function showAction(Likes $like)
    {
        $deleteForm = $this->createDeleteForm($like);

        return $this->render('likes/show.html.twig', array(
            'like' => $like,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing like entity.
     *
     * @Route("/{id}/edit", name="likes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Likes $like)
    {
        $deleteForm = $this->createDeleteForm($like);
        $editForm = $this->createForm('ServiceBundle\Form\LikesType', $like);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('likes_edit', array('id' => $like->getId()));
        }

        return $this->render('likes/edit.html.twig', array(
            'like' => $like,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a like entity.
     *
     * @Route("/{id}", name="likes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Likes $like)
    {
        $form = $this->createDeleteForm($like);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($like);
            $em->flush();
        }

        return $this->redirectToRoute('likes_index');
    }

    /**
     * Creates a form to delete a like entity.
     *
     * @param Likes $like The like entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Likes $like)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('likes_delete', array('id' => $like->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
