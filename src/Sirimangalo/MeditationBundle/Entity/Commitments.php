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



    /**
     * Get cid
     *
     * @return integer 
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Commitments
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Commitments
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set creatorid
     *
     * @param integer $creatorid
     * @return Commitments
     */
    public function setCreatorid($creatorid)
    {
        $this->creatorid = $creatorid;

        return $this;
    }

    /**
     * Get creatorid
     *
     * @return integer 
     */
    public function getCreatorid()
    {
        return $this->creatorid;
    }

    /**
     * Set period
     *
     * @param string $period
     * @return Commitments
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return string 
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set day
     *
     * @param integer $day
     * @return Commitments
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set time
     *
     * @param string $time
     * @return Commitments
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return Commitments
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return string 
     */
    public function getLength()
    {
        return $this->length;
    }
}
