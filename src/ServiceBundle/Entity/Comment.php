<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
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
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;


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
     * @return string
     */
    public function getTextcomment()
    {
        return $this->textcomment;
    }

    /**
     * @param string $textcomment
     */
    public function setTextcomment($textcomment)
    {
        $this->textcomment = $textcomment;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
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

