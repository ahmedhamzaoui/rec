<?php

namespace ServiceBundle\Controller;

use ServiceBundle\Entity\Tags;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Tag controller.
 *
 */
class TagsController extends Controller
{
    /**
     * Lists all tag entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('ServiceBundle:Tags')->findAll();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tags);
        return new JsonResponse($formatted);
    }

    /**
     * Creates a new tag entity.
     *
     */
    public function newAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm('ServiceBundle\Form\TagsType', $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('tags_show', array('id' => $tag->getId()));
        }

        return $this->render('tags/new.html.twig', array(
            'tag' => $tag,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tag entity.
     *
     */
    public function showAction(Tags $tag)
    {
        $deleteForm = $this->createDeleteForm($tag);

        return $this->render('tags/show.html.twig', array(
            'tag' => $tag,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tag entity.
     *
     */
    public function editAction(Request $request, Tags $tag)
    {
        $deleteForm = $this->createDeleteForm($tag);
        $editForm = $this->createForm('ServiceBundle\Form\TagsType', $tag);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tags_edit', array('id' => $tag->getId()));
        }

        return $this->render('tags/edit.html.twig', array(
            'tag' => $tag,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tag entity.
     *
     */
    public function deleteAction(Request $request, Tags $tag)
    {
        $form = $this->createDeleteForm($tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tag);
            $em->flush();
        }

        return $this->redirectToRoute('tags_index');
    }

    /**
     * Creates a form to delete a tag entity.
     *
     * @param Tags $tag The tag entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tags $tag)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tags_delete', array('id' => $tag->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
