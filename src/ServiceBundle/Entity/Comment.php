<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment", indexes={@ORM\Index(name="userid", columns={"userid"}), @ORM\Index(name="idpost", columns={"idpost"})})
 * @ORM\Entity
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="textcomment", type="string", length=10000, nullable=false)
     */
    private $textcomment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=false)
     */
    private $createdAt;

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

