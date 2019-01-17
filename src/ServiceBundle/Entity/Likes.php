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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Post
     */
    public function getIdpost()
    {
        return $this->idpost;
    }

    /**
     * @param Post $idpost
     */
    public function setIdpost($idpost)
    {
        $this->idpost = $idpost;
    }

    /**
     * @return Users
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param Users $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }


}

