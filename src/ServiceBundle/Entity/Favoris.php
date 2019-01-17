<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favoris
 *
 * @ORM\Table(name="favoris")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\FavorisRepository")
 */
class Favoris
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * @var int
     *
     * @ORM\Column(name="idpost", type="integer")
     */
    private $idpost;

    /**
     * @var int
     *
     * @ORM\Column(name="userid", type="integer")
     */
    private $userid;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIdpost()
    {
        return $this->idpost;
    }

    /**
     * @param int $idpost
     */
    public function setIdpost($idpost)
    {
        $this->idpost = $idpost;
    }

    /**
     * @return int
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param int $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }
}


