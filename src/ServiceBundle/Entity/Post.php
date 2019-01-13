<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Post
 *
 * @ORM\Table(name="post", indexes={@ORM\Index(name="userid", columns={"userid"}), @ORM\Index(name="idphoto1", columns={"idphoto1"}), @ORM\Index(name="idphoto2", columns={"idphoto2"}), @ORM\Index(name="idphoto3", columns={"idphoto3"}), @ORM\Index(name="idphoto4", columns={"idphoto4"})})
 * @ORM\Entity
 */
class Post
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpub", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpub;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=512, nullable=false)
     */
    private $tag;

    /**
     * @var integer
     *
     * @ORM\Column(name="userid", type="integer", nullable=false)
     */
    private $userid;

    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float", nullable=false)
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="lng", type="float", nullable=false)
     */
    private $lng;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=512, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=3000, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @var \ServiceBundle\Entity\Photo
     *
     * @ORM\ManyToOne(targetEntity="ServiceBundle\Entity\Photo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idphoto3", referencedColumnName="id")
     * })
     */
    private $idphoto3;

    /**
     * @var \ServiceBundle\Entity\Photo
     *
     * @ORM\ManyToOne(targetEntity="ServiceBundle\Entity\Photo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idphoto2", referencedColumnName="id")
     * })
     */
    private $idphoto2;

    /**
     * @var \ServiceBundle\Entity\Photo
     *
     * @ORM\ManyToOne(targetEntity="ServiceBundle\Entity\Photo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idphoto4", referencedColumnName="id")
     * })
     */
    private $idphoto4;

    /**
     * @var \ServiceBundle\Entity\Photo
     *
     * @ORM\ManyToOne(targetEntity="ServiceBundle\Entity\Photo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idphoto1", referencedColumnName="id")
     * })
     */
    private $idphoto1;

    /**
     * @return int
     */
    public function getIdpub()
    {
        return $this->idpub;
    }

    /**
     * @param int $idpub
     */
    public function setIdpub($idpub)
    {
        $this->idpub = $idpub;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
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

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param float $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return \Photo
     */
    public function getIdphoto3()
    {
        return $this->idphoto3;
    }

    /**
     * @param \Photo $idphoto3
     */
    public function setIdphoto3($idphoto3)
    {
        $this->idphoto3 = $idphoto3;
    }

    /**
     * @return \Photo
     */
    public function getIdphoto2()
    {
        return $this->idphoto2;
    }

    /**
     * @param \Photo $idphoto2
     */
    public function setIdphoto2($idphoto2)
    {
        $this->idphoto2 = $idphoto2;
    }

    /**
     * @return \Photo
     */
    public function getIdphoto4()
    {
        return $this->idphoto4;
    }

    /**
     * @param \Photo $idphoto4
     */
    public function setIdphoto4($idphoto4)
    {
        $this->idphoto4 = $idphoto4;
    }

    /**
     * @return \Photo
     */
    public function getIdphoto1()
    {
        return $this->idphoto1;
    }

    /**
     * @param \Photo $idphoto1
     */
    public function setIdphoto1($idphoto1)
    {
        $this->idphoto1 = $idphoto1;
    }



}

