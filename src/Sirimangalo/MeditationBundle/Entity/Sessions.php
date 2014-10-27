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
     * @ORM\Column(name="sid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="uid")
     * })
     */
    protected $user;


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
     * @ORM\Column(name="end", type="datetime", nullable=true)
     */
    private $end = true;

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

    /**
     * Set user
     *
     * @param \Sirimangalo\MeditationBundle\Entity\User $user
     * @return Sessions
     */
    public function setUser(\Sirimangalo\MeditationBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Sirimangalo\MeditationBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
