<?php

namespace abs\fivepointsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * conversation
 *
 * @ORM\Table(name="conversation")
 * @ORM\Entity(repositoryClass="abs\fivepointsBundle\Repository\conversationRepository")
 */
class conversation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="abs\userBundle\Entity\User", inversedBy="conversations")
     * @ORM\JoinColumn(name="firstUser_id", nullable=false)
     */
    private $firstUser;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="abs\userBundle\Entity\User")
     * @ORM\JoinColumn(name="secondeUser_id", nullable=false)
     */
    private $secondeUser;

    /**
     * @ORM\OneToMany(targetEntity="abs\fivepointsBundle\Entity\message", mappedBy="conversation")
     */
    private $messages;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->messages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstUser.
     *
     * @param \abs\userBundle\Entity\User $firstUser
     *
     * @return conversation
     */
    public function setFirstUser(\abs\userBundle\Entity\User $firstUser)
    {
        $this->firstUser = $firstUser;

        return $this;
    }

    /**
     * Get firstUser.
     *
     * @return \abs\userBundle\Entity\User
     */
    public function getFirstUser()
    {
        return $this->firstUser;
    }

    /**
     * Set secondeUser.
     *
     * @param \abs\userBundle\Entity\User $secondeUser
     *
     * @return conversation
     */
    public function setSecondeUser(\abs\userBundle\Entity\User $secondeUser)
    {
        $this->secondeUser = $secondeUser;

        return $this;
    }

    /**
     * Get secondeUser.
     *
     * @return \abs\userBundle\Entity\User
     */
    public function getSecondeUser()
    {
        return $this->secondeUser;
    }

    /**
     * Add message.
     *
     * @param \abs\fivepointsBundle\Entity\message $message
     *
     * @return conversation
     */
    public function addMessage(\abs\fivepointsBundle\Entity\message $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message.
     *
     * @param \abs\fivepointsBundle\Entity\message $message
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMessage(\abs\fivepointsBundle\Entity\message $message)
    {
        return $this->messages->removeElement($message);
    }

    /**
     * Get messages.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
