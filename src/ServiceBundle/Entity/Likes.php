<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="likes", indexes={@ORM\Index(name="userid", columns={"userid"}), @ORM\Index(name="idpost", columns={"idpost"})})
 * @ORM\Entity
 */
class Likes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \ServiceBundle\Entity\Post
     *
     * @ORM\ManyToOne(targetEntity="ServiceBundle\Entity\Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idpost", referencedColumnName="idpub")
     * })
     */
    private $idpost;

    /**
     * @var \ServiceBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="ServiceBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userid", referencedColumnName="id")
     * })
     */
    private $userid;


}

