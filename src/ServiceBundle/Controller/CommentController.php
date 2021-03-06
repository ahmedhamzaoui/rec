<?php

namespace ServiceBundle\Controller;

use ServiceBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Comment controller.
 *
 */
class CommentController extends Controller
{
    /**
     * Lists all comment entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $comments = $em->getRepository('ServiceBundle:Comment')->findBy(array("idpost"=>$request->get("idpost")));

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($comments);
        return new JsonResponse($formatted);
    }




    public function nbAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $comment = $em->getRepository('ServiceBundle:Comment')->findBy(array("idpost"=>$request->get("idpost")));
        $x=0;
        foreach ($comment as $comm){
            $x++;
        }
        if($comment!=null){
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
     * Creates a new comment entity.
     *
     */
    public function newAction(Request $request)
    {

        $userid=$request->get("userid");
        $idpost=$request->get("idpost");
        $comme=$request->get("comment");
        $date=$request->get("createdAt");

        $comment = new Comment();
       $comment->setIdpost($idpost);
       $comment->setUserid($userid);
       $comment->setTextcomment($comme);
       $comment->setCreatedAt($date);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($comment->getId());
        return new JsonResponse($formatted);
    }

    /**
     * Finds and displays a comment entity.
     *
     */
    public function showAction(Comment $comment)
    {
        $deleteForm = $this->createDeleteForm($comment);

        return $this->render('comment/show.html.twig', array(
            'comment' => $comment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing comment entity.
     *
     */
    public function editAction(Request $request, Comment $comment)
    {
        $deleteForm = $this->createDeleteForm($comment);
        $editForm = $this->createForm('ServiceBundle\Form\CommentType', $comment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comment_edit', array('id' => $comment->getId()));
        }

        return $this->render('comment/edit.html.twig', array(
            'comment' => $comment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a comment entity.
     *
     */
    public function deleteAction(Request $request, Comment $comment)
    {
        $form = $this->createDeleteForm($comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();
        }

        return $this->redirectToRoute('comment_index');
    }

    /**
     * Creates a form to delete a comment entity.
     *
     * @param Comment $comment The comment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Comment $comment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comment_delete', array('id' => $comment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
