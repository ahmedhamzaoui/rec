<?php

namespace ServiceBundle\Controller;

use ServiceBundle\Entity\Favoris;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Favori controller.
 *
 */
class FavorisController extends Controller
{
    /**
     * Lists all favori entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $favoris = $em->getRepository('ServiceBundle:Favoris')->findOneBy(array("userid"=>$request->get("userid"),"idpost"=>$request->get("idpost")));
        if($favoris!=null){
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($favoris->getIdpost());
        return new JsonResponse($formatted);
        }
        else{
            $s="";
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize($s);
                return new JsonResponse($formatted);
            }

    }

    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $favoris = $em->getRepository('ServiceBundle:Favoris')->findBy(array("userid"=>$request->get("userid")));
        if($favoris!=null){
            $tab=array();

            foreach ($favoris as $f){
            $fav = $em->getRepository('ServiceBundle:Post')->findBy(array("idpub"=>$f->getIdpost()));
            array_push($tab,$fav);
            }
            $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tab);
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
     * Creates a new favori entity.
     *
     */
    public function newAction(Request $request)
    {
        $userid=$request->get("userid");
        $idpost=$request->get("idpost");

        $em = $this->getDoctrine()->getManager();
        $favori=$em->getRepository("ServiceBundle:Favoris")->findOneBy(array("idpost"=>$idpost,"userid"=>$userid));


        if ($favori==null) {
            $favori = new Favoris();
            $favori->setUserid($userid);
            $favori->setIdpost($idpost);
            $em->persist($favori);
            $em->flush();
        }else if ($favori!=null){
            $em->remove($favori);
            $em->flush();

        }

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($favori->getId());
        return new JsonResponse($formatted);
    }

    /**
     * Finds and displays a favori entity.
     *
     */
    public function showAction(Favoris $favori)
    {
        $deleteForm = $this->createDeleteForm($favori);

        return $this->render('favoris/show.html.twig', array(
            'favori' => $favori,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing favori entity.
     *
     */
    public function editAction(Request $request, Favoris $favori)
    {
        $deleteForm = $this->createDeleteForm($favori);
        $editForm = $this->createForm('ServiceBundle\Form\FavorisType', $favori);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('favoris_edit', array('id' => $favori->getId()));
        }

        return $this->render('favoris/edit.html.twig', array(
            'favori' => $favori,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a favori entity.
     *
     */
    public function deleteAction(Request $request, Favoris $favori)
    {
        $form = $this->createDeleteForm($favori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($favori);
            $em->flush();
        }

        return $this->redirectToRoute('favoris_index');
    }

    /**
     * Creates a form to delete a favori entity.
     *
     * @param Favoris $favori The favori entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Favoris $favori)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('favoris_delete', array('id' => $favori->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
