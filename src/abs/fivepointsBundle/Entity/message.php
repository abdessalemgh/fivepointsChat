<?php

namespace abs\fivepointsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="abs\fivepointsBundle\Repository\messageRepository")
 */
class message
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
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="abs\userBundle\Entity\User", inversedBy="messages")
     * @ORM\JoinColumn(name="sender_id", nullable=false)
     */
    private $sender;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="abs\fivepointsBundle\Entity\conversation", inversedBy="messages")
     * @ORM\JoinColumn(name="conversation_id", nullable=false)
     */
    private $conversation;

    public function __construct()
    {
        $this->time = new \DateTime('now');
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
     * Set text.
     *
     * @param string $text
     *
     * @return message
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set time.
     *
     * @param \DateTime $time
     *
     * @return message
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time.
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set sender.
     *
     * @param \abs\userBundle\Entity\User|null $sender
     *
     * @return message
     */
    public function setSender(\abs\userBundle\Entity\User $sender = null)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender.
     *
     * @return \abs\userBundle\Entity\User|null
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set conversation.
     *
     * @param \abs\fivepointsBundle\Entity\conversation $conversation
     *
     * @return message
     */
    public function setConversation(\abs\fivepointsBundle\Entity\conversation $conversation)
    {
        $this->conversation = $conversation;

        return $this;
    }

    /**
     * Get conversation.
     *
     * @return \abs\fivepointsBundle\Entity\conversation
     */
    public function getConversation()
    {
        return $this->conversation;
    }
}
