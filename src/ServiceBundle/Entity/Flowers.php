<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flowers
 *
 * @ORM\Table(name="flowers", indexes={@ORM\Index(name="uderid", columns={"userid"})})
 * @ORM\Entity
 */
class Flowers
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
     * @ORM\Column(name="idflowers", type="text", length=65535, nullable=true)
     */
    private $idflowers;

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

