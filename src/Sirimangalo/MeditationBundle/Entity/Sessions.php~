<?php

namespace Sirimangalo\MeditationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sessions
 *
 * @ORM\Table(name="sessions")
 * @ORM\Entity
 */
class Sessions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sid", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sid;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     */
    private $uid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime", nullable=false)
     */
    private $start;

    /**
     * @var integer
     *
     * @ORM\Column(name="walking", type="integer", nullable=false)
     */
    private $walking;

    /**
     * @var integer
     *
     * @ORM\Column(name="sitting", type="integer", nullable=false)
     */
    private $sitting;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime", nullable=false)
     */
    private $end;



    /**
     * Get sid
     *
     * @return integer 
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * Set uid
     *
     * @param integer $uid
     * @return Sessions
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return integer 
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     * @return Sessions
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set walking
     *
     * @param integer $walking
     * @return Sessions
     */
    public function setWalking($walking)
    {
        $this->walking = $walking;

        return $this;
    }

    /**
     * Get walking
     *
     * @return integer 
     */
    public function getWalking()
    {
        return $this->walking;
    }

    /**
     * Set sitting
     *
     * @param integer $sitting
     * @return Sessions
     */
    public function setSitting($sitting)
    {
        $this->sitting = $sitting;

        return $this;
    }

    /**
     * Get sitting
     *
     * @return integer 
     */
    public function getSitting()
    {
        return $this->sitting;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Sessions
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }
}
