<?php

namespace Sirimangalo\MeditationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commitments
 *
 * @ORM\Table(name="commitments")
 * @ORM\Entity
 */
class Commitments
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cid;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=64, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="creatorid", type="integer", nullable=false)
     */
    private $creatorid;

    /**
     * @var string
     *
     * @ORM\Column(name="period", type="string", length=10, nullable=false)
     */
    private $period;

    /**
     * @var integer
     *
     * @ORM\Column(name="day", type="integer", nullable=false)
     */
    private $day;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="string", length=5, nullable=false)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="length", type="string", length=100, nullable=false)
     */
    private $length;


}
