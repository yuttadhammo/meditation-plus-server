<?php

namespace Sirimangalo\MeditationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserCommitments
 *
 * @ORM\Table(name="user_commitments", uniqueConstraints={@ORM\UniqueConstraint(name="commit", columns={"cid", "uid"})}, indexes={@ORM\Index(name="IDX_EE558C564B30D9C4", columns={"cid"})})
 * @ORM\Entity
 */
class UserCommitments
{
    /**
     * @var integer
     *
     * @ORM\Column(name="aid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aid;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     */
    private $uid;

    /**
     * @var \Commitments
     *
     * @ORM\ManyToOne(targetEntity="Commitments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cid", referencedColumnName="cid")
     * })
     */
    private $cid;


}
