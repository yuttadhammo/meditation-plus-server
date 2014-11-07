<?php
namespace Sirimangalo\MeditationBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commitments
 *
 * @ORM\Table(name="commitments")
 * @ORM\Entity(repositoryClass="Sirimangalo\MeditationBundle\Entity\CommitmentRepository")
 */
class Commitment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=64)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $description;

     /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="creatorid", referencedColumnName="uid")
     * })
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="UserCommitment", mappedBy="commitment")
     **/
    protected $userCommitments;

    /**
     * @var string
     *
     * @ORM\Column(name="period", type="string", length=10, nullable=false)
     * @Assert\NotBlank()
     */
    private $period;

    /**
     * @var integer
     *
     * @ORM\Column(name="day", type="integer", nullable=true)
     */
    private $day;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="string", length=5, nullable=true)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="length", type="string", length=100, nullable=false)
     * @Assert\NotBlank()
     */
    private $length;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Commitment
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
     * @return Commitment
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
     * Set period
     *
     * @param string $period
     * @return Commitment
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
     * @return Commitment
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
     * @return Commitment
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
     * @return Commitment
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

    /**
     * Set user
     *
     * @param \Sirimangalo\MeditationBundle\Entity\User $user
     * @return Commitment
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
     * Constructor
     */
    public function __construct()
    {
        $this->userCommitments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add userCommitments
     *
     * @param \Sirimangalo\MeditationBundle\Entity\UserCommitment $userCommitments
     * @return Commitment
     */
    public function addUserCommitment(\Sirimangalo\MeditationBundle\Entity\UserCommitment $userCommitments)
    {
        $this->userCommitments[] = $userCommitments;

        return $this;
    }

    /**
     * Remove userCommitments
     *
     * @param \Sirimangalo\MeditationBundle\Entity\UserCommitment $userCommitments
     */
    public function removeUserCommitment(\Sirimangalo\MeditationBundle\Entity\UserCommitment $userCommitments)
    {
        $this->userCommitments->removeElement($userCommitments);
    }

    /**
     * Get userCommitments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserCommitments()
    {
        return $this->userCommitments;
    }
}
