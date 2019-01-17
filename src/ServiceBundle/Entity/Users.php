<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="idflowers", columns={"idflowers"}), @ORM\Index(name="idfollowing", columns={"idfollowing"})})
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\UsersRepository")
 */
class Users
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
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=64, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=512, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=512, nullable=true)
     */
    private $fullname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=512, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="idflowers", type="integer", nullable=true)
     */
    private $idflowers;

    /**
     * @var integer
     *
     * @ORM\Column(name="idfollowing", type="integer", nullable=true)
     */
    private $idfollowing;


    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=512, nullable=true)
     */
    private $path;

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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param string $fullname
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
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
     * @return int
     */
    public function getIdflowers()
    {
        return $this->idflowers;
    }

    /**
     * @param int $idflowers
     */
    public function setIdflowers($idflowers)
    {
        $this->idflowers = $idflowers;
    }

    /**
     * @return int
     */
    public function getIdfollowing()
    {
        return $this->idfollowing;
    }

    /**
     * @param int $idfollowing
     */
    public function setIdfollowing($idfollowing)
    {
        $this->idfollowing = $idfollowing;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }




}

