<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Following
 *
 * @ORM\Table(name="following", indexes={@ORM\Index(name="uderid", columns={"userid"})})
 * @ORM\Entity
 */
class Following
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
     * @ORM\Column(name="idfollowing", type="text", length=65535, nullable=true)
     */
    private $idfollowing;

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

