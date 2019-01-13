<?php

namespace ServiceBundle\Controller;

use ServiceBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{
    /**
     * http://localhost/reclamation/web/app_dev.php/posts/
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('ServiceBundle:Post')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($posts);
        return new JsonResponse($formatted);
    }

    /**
     * http://localhost/reclamation/web/app_dev.php/posts/new?tag=&userid=&lat=&lng=&titre=&description=
     *
     */
    public function newAction(Request $request)
    {

        $tag = $request->get("tag");
        $userid = $request->get("userid");
        $lat = $request->get("lat");
        $lng = $request->get("lng");
        $titre = $request->get("titre");
        $description = $request->get("description");

        $em = $this->getDoctrine()->getManager();
        $post = new Post();
        if (($tag!="")&&($userid!="")&&($lat!="")&&($lng!="")&&($titre!="")&&($description!="")){
        $post->setTag($tag);
        $post->setUserid($userid);
        $post->setLat($lat);
        $post->setLng($lng);
        $post->setTitre($titre);
        $post->setDescription($description);
        $post->setCreatedAt(new \DateTime('now'));
            $em->persist($post);
            $em->flush();

            $msg=array("response"=>"success");
        }
        else{
            $msg=array("response"=>"erreur");
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($msg);
        return new JsonResponse($formatted);
    }

        /**
     * http://localhost/reclamation/web/app_dev.php/posts/idpub/show
     *
     */
    public function showAction($idpub)
    {

        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('ServiceBundle:Post')->find($idpub);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($post);
        return new JsonResponse($formatted);

    }

    /**
     * http://localhost/reclamation/web/app_dev.php/posts/idpub/edit?tag=&titre=&description=
     *
     */
    public function editAction(Request $request,$idpub)
    {

        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('ServiceBundle:Post')->find($idpub);

        $tag = $request->get("tag");
        $titre = $request->get("titre");
        $description = $request->get("description");

        $em = $this->getDoctrine()->getManager();
        if (($tag!="")&&($titre!="")&&($description!="")){
            $post->setTag($tag);
            $post->setTitre($titre);
            $post->setDescription($description);
            $em->flush();

            $msg=array("response"=>"success");
        }
        else{
            $msg=array("response"=>"erreur");
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($msg);
        return new JsonResponse($formatted);
    }

    /**
     * Deletes a post entity.
     *
     */
    public function deleteAction($idpub)
    {

        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('ServiceBundle:Post')->find($idpub);
        if ($post!=null){
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();

            $msg=array("response"=>"success");
        }
        else{
            $msg=array("response"=>"erreur");
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($msg);
        return new JsonResponse($formatted);

    }


}
