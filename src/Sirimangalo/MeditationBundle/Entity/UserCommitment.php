<?php

namespace Sirimangalo\MeditationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserCommitment
 *
 * @ORM\Table(name="user_commitments", uniqueConstraints={@ORM\UniqueConstraint(name="commit", columns={"cid", "uid"})}, indexes={@ORM\Index(name="IDX_EE558C564B30D9C4", columns={"cid"})})
 * @ORM\Entity
 */
class UserCommitment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="aid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="uid", referencedColumnName="uid")
     * })
     */
    private $user;

    /**
     * @var \Commitments
     *
     * @ORM\ManyToOne(targetEntity="Commitment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cid", referencedColumnName="cid")
     * })
     */
    private $commitment;


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
     * Set user
     *
     * @param \Sirimangalo\MeditationBundle\Entity\User $user
     * @return UserCommitment
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
     * Set commitment
     *
     * @param \Sirimangalo\MeditationBundle\Entity\Commitments $commitment
     * @return UserCommitment
     */
    public function setCommitment(\Sirimangalo\MeditationBundle\Entity\Commitment $commitment = null)
    {
        $this->commitment = $commitment;

        return $this;
    }

    /**
     * Get commitment
     *
     * @return \Sirimangalo\MeditationBundle\Entity\Commitments
     */
    public function getCommitment()
    {
        return $this->commitment;
    }
}
